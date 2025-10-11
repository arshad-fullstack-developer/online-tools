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
        Schema::table('tools', function (Blueprint $table) {
            $table->string('tool_type')->default('custom')->after('component_name'); // custom, calculator, converter, text-tool, etc.
            $table->json('configuration')->nullable()->after('tool_type'); // Tool configuration (fields, formulas, etc.)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->dropColumn(['tool_type', 'configuration']);
        });
    }
};
