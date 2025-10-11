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
        Schema::create('timezones', function (Blueprint $table) {
            $table->id();
            $table->string('value')->unique(); // e.g., 'America/New_York'
            $table->string('label'); // e.g., 'Eastern Time (ET) - New York'
            $table->string('city')->nullable(); // e.g., 'New York'
            $table->string('country')->nullable(); // e.g., 'United States'
            $table->string('region'); // e.g., 'Americas', 'Europe', 'Middle East'
            $table->boolean('is_popular')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timezones');
    }
};
