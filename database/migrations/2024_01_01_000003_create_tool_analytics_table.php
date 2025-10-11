<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tool_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained()->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('country')->nullable();
            $table->string('action_type'); // view, use
            $table->json('metadata')->nullable();
            $table->timestamp('created_at');
            
            // Indexes
            $table->index('tool_id');
            $table->index('action_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_analytics');
    }
};
