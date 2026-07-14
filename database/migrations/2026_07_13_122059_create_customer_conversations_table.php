<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_conversations', function (Blueprint $table) {
            $table->id();
            $table->integer('ticket_id');
            $table->string('sender');
            $table->string('communication_type')->default('Chat');
            $table->text('message');
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_conversations');
    }
};