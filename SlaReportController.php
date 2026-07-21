<?php

namespace App\Http\Controllers;

use App\Models\SlaWeeklyCompliance;
use App\Models\SlaPriorityPerformance;
use App\Models\SlaTarget;
use App\Models\SlaMetric;
use App\Models\Ticket;
use App\Services\SlaCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SlaReportController extends Controller
{
    public function index()
    {
        // Auto-calculate SLA data before displaying
        SlaCalculator::updateSlaData();

        $weeklyCompliance = SlaWeeklyCompliance::orderBy('sort_order')->get();
        $priorityPerformance = SlaPriorityPerformance::orderBy('sort_order')->get();
        $slaTargets = SlaTarget::orderBy('sort_order')->get();
        $metrics = SlaMetric::all()->keyBy('metric_name');
        
        return view('sla-reports.index', compact(
            'weeklyCompliance',
            'priorityPerformance',
            'slaTargets',
            'metrics'
        ));
    }

    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');

        $weeklyCompliance = SlaWeeklyCompliance::orderBy('sort_order')->get();
        $priorityPerformance = SlaPriorityPerformance::orderBy('sort_order')->get();
        $slaTargets = SlaTarget::orderBy('sort_order')->get();

        if ($format === 'csv') {
            return $this->exportCsv($weeklyCompliance, $priorityPerformance, $slaTargets);
        }

        if ($format === 'json') {
            return $this->exportJson($weeklyCompliance, $priorityPerformance, $slaTargets);
        }

        return redirect()->back()->with('error', 'Unsupported format');
    }

    private function exportCsv($weekly, $priority, $targets)
    {
        $filename = 'sla_reports_' . now()->format('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($weekly, $priority, $targets) {
            $file = fopen('php://output', 'w');

            // Weekly Compliance Section
            fputcsv($file, ['SLA Reports Export']);
            fputcsv($file, ['Generated: ' . now()->toDateTimeString()]);
            fputcsv($file, []);
            fputcsv($file, ['Weekly SLA Compliance Trend']);
            fputcsv($file, ['Week', 'Compliance %', 'Ticket Count']);
            foreach ($weekly as $item) {
                fputcsv($file, [$item->week_name, $item->compliance_percentage, $item->ticket_count]);
            }

            fputcsv($file, []);
            fputcsv($file, ['Performance by Priority Level']);
            fputcsv($file, ['Priority', 'Compliance %']);
            foreach ($priority as $item) {
                fputcsv($file, [$item->priority_level, $item->compliance_percentage]);
            }

            fputcsv($file, []);
            fputcsv($file, ['SLA Targets by Priority']);
            fputcsv($file, ['Priority', 'Target Time', 'Actual Time', 'Compliance %', 'Ticket Count', 'Status']);
            foreach ($targets as $item) {
                fputcsv($file, [
                    $item->priority_level,
                    $item->target_time,
                    $item->actual_time,
                    $item->compliance_percentage,
                    $item->ticket_count,
                    $item->status
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    private function exportJson($weekly, $priority, $targets)
    {
        $data = [
            'exported_at' => now()->toDateTimeString(),
            'weekly_compliance' => $weekly,
            'priority_performance' => $priority,
            'sla_targets' => $targets,
        ];

        return response()->json($data, 200, [
            'Content-Disposition' => 'attachment; filename="sla_reports_' . now()->format('Y-m-d_His') . '.json"'
        ]);
    }
}