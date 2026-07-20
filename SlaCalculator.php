<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\SlaTarget;
use App\Models\SlaPriorityPerformance;
use App\Models\SlaWeeklyCompliance;
use App\Models\SlaMetric;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SlaCalculator
{
    // SLA Target Times (in hours)
    const TARGET_TIMES = [
        'Critical' => 4,
        'High' => 8,
        'Medium' => 16,
        'Low' => 24,
    ];

    /**
     * Safely calculate time difference in hours
     * Handles cases where timestamps might be in wrong order
     */
    private static function safeDiffInHours($start, $end): ?float
    {
        if (!$start || !$end) return null;

        $startCarbon = Carbon::parse($start);
        $endCarbon = Carbon::parse($end);

        // Always use the earlier time as start, later as end
        $actualStart = $startCarbon->min($endCarbon);
        $actualEnd = $startCarbon->max($endCarbon);

        $minutes = $actualStart->diffInMinutes($actualEnd);

        return round($minutes / 60, 2);
    }

    public static function calculateResponseTime(Ticket $ticket): ?float
    {
        return self::safeDiffInHours($ticket->created_at, $ticket->responded_at);
    }

    public static function calculateResolutionTime(Ticket $ticket): ?float
    {
        return self::safeDiffInHours($ticket->created_at, $ticket->resolved_at);
    }

    public static function isCompliant(Ticket $ticket, float $actualTime): bool
    {
        $targetTime = self::TARGET_TIMES[$ticket->priority_level] ?? 24;
        return $actualTime <= $targetTime;
    }

    public static function calculateCompliancePercentage(string $priorityLevel): float
    {
        $tickets = Ticket::where('priority_level', $priorityLevel)
            ->whereNotNull('resolved_at')
            ->get();

        if ($tickets->isEmpty()) return 0;

        $compliantCount = 0;
        foreach ($tickets as $ticket) {
            $resolutionTime = self::calculateResolutionTime($ticket);
            if ($resolutionTime !== null && self::isCompliant($ticket, $resolutionTime)) {
                $compliantCount++;
            }
        }

        return round(($compliantCount / $tickets->count()) * 100, 2);
    }

    /**
     * Calculate weekly compliance data from actual tickets
     */
    public static function calculateWeeklyCompliance(): array
    {
        $now = Carbon::now();
        $weeks = [];

        for ($i = 4; $i >= 0; $i--) {
            $weekStart = $now->copy()->subWeeks($i)->startOfWeek();
            $weekEnd = $weekStart->copy()->endOfWeek();
            $weekName = 'Week ' . (5 - $i);

            // Get all tickets created in this week
            $weekTickets = Ticket::whereBetween('created_at', [$weekStart, $weekEnd])->get();

            // Get resolved tickets in this week
            $resolvedWeekTickets = $weekTickets->whereNotNull('resolved_at');
            $totalResolved = $resolvedWeekTickets->count();

            // Calculate compliance for resolved tickets
            $met = 0;
            foreach ($resolvedWeekTickets as $ticket) {
                $resolutionTime = self::calculateResolutionTime($ticket);
                if ($resolutionTime !== null && self::isCompliant($ticket, $resolutionTime)) {
                    $met++;
                }
            }

            $compliance = $totalResolved > 0 ? round(($met / $totalResolved) * 100) : 0;

            $weeks[] = [
                'week_name' => $weekName,
                'compliance_percentage' => $compliance,
                'ticket_count' => $weekTickets->count(),
                'sort_order' => 5 - $i,
            ];
        }

        return $weeks;
    }

    public static function updateSlaData()
    {
        // Update priority performance
        foreach (['Critical', 'High', 'Medium', 'Low'] as $priority) {
            $compliance = self::calculateCompliancePercentage($priority);

            SlaPriorityPerformance::where('priority_level', $priority)
                ->update(['compliance_percentage' => $compliance]);
        }

        // Update SLA targets
        foreach (['Critical', 'High', 'Medium', 'Low'] as $priority) {
            $tickets = Ticket::where('priority_level', $priority)
                ->whereNotNull('resolved_at')
                ->get();

            if ($tickets->isNotEmpty()) {
                $avgResolutionTime = $tickets->avg(function ($ticket) {
                    return self::calculateResolutionTime($ticket);
                });

                $compliance = self::calculateCompliancePercentage($priority);

                SlaTarget::where('priority_level', $priority)
                    ->update([
                        'actual_time' => round($avgResolutionTime, 1) . 'h',
                        'compliance_percentage' => $compliance,
                        'ticket_count' => $tickets->count()
                    ]);
            } else {
                SlaTarget::where('priority_level', $priority)
                    ->update([
                        'actual_time' => '0h',
                        'compliance_percentage' => 0,
                        'ticket_count' => 0
                    ]);
            }
        }

        // Update weekly compliance
        $weeklyData = self::calculateWeeklyCompliance();
        foreach ($weeklyData as $week) {
            SlaWeeklyCompliance::where('week_name', $week['week_name'])
                ->update([
                    'compliance_percentage' => $week['compliance_percentage'],
                    'ticket_count' => $week['ticket_count'],
                ]);
        }

        // Update metrics
        $totalTickets = Ticket::count();
        $resolvedTickets = Ticket::whereNotNull('resolved_at')->count();

        if ($resolvedTickets > 0) {
            $overallCompliance = Ticket::whereNotNull('resolved_at')
                ->get()
                ->filter(function ($ticket) {
                    $time = self::calculateResolutionTime($ticket);
                    return $time !== null && self::isCompliant($ticket, $time);
                })
                ->count();

            $overallPercentage = round(($overallCompliance / $resolvedTickets) * 100);

            SlaMetric::where('metric_name', 'overall_compliance')
                ->update(['metric_value' => $overallPercentage]);

            // Avg response time
            $avgResponse = Ticket::whereNotNull('responded_at')
                ->get()
                ->avg(function ($ticket) {
                    return self::calculateResponseTime($ticket);
                });

            if ($avgResponse) {
                SlaMetric::where('metric_name', 'avg_response_time')
                    ->update(['metric_value' => round($avgResponse, 1) . ' hours']);
            }

            // Avg resolution time
            $avgResolution = Ticket::whereNotNull('resolved_at')
                ->get()
                ->avg(function ($ticket) {
                    return self::calculateResolutionTime($ticket);
                });

            if ($avgResolution) {
                SlaMetric::where('metric_name', 'avg_resolution_time')
                    ->update(['metric_value' => round($avgResolution, 1) . ' hours']);
            }
        } else {
            SlaMetric::where('metric_name', 'overall_compliance')
                ->update(['metric_value' => '0']);
            SlaMetric::where('metric_name', 'avg_response_time')
                ->update(['metric_value' => '0 hours']);
            SlaMetric::where('metric_name', 'avg_resolution_time')
                ->update(['metric_value' => '0 hours']);
        }
    }
}