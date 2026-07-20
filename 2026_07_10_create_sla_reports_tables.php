<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SLA Compliance Weekly Data (Frames 36-40)
        Schema::create('sla_weekly_compliance', function (Blueprint $table) {
            $table->id();
            $table->string('week_name'); // Week 1, Week 2, etc.
            $table->integer('compliance_percentage');
            $table->integer('ticket_count');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Priority Level Performance (Frames 41-44)
        Schema::create('sla_priority_performance', function (Blueprint $table) {
            $table->id();
            $table->string('priority_level'); // Critical, High, Medium, Low
            $table->integer('compliance_percentage');
            $table->string('color_class')->default('bg-blue-500');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // SLA Targets Table
        Schema::create('sla_targets', function (Blueprint $table) {
            $table->id();
            $table->string('priority_level');
            $table->string('target_time');
            $table->string('actual_time');
            $table->integer('compliance_percentage');
            $table->integer('ticket_count');
            $table->string('status')->default('On Track');
            $table->string('badge_color')->default('bg-green-100');
            $table->string('badge_text_color')->default('text-green-800');
            $table->string('progress_color')->default('bg-green-500');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Overall Metrics
        Schema::create('sla_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('metric_name'); // overall_compliance, avg_response_time, avg_resolution_time
            $table->string('metric_value');
            $table->string('metric_label');
            $table->string('icon_class')->nullable();
            $table->string('icon_bg')->nullable();
            $table->string('trend_text')->nullable();
            $table->string('trend_direction')->nullable(); // up, down
            $table->string('target_value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sla_weekly_compliance');
        Schema::dropIfExists('sla_priority_performance');
        Schema::dropIfExists('sla_targets');
        Schema::dropIfExists('sla_metrics');
    }
};