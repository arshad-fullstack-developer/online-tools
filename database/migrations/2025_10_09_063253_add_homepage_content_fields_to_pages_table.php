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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('hero_badge')->nullable()->after('content');
            $table->string('hero_title')->nullable()->after('hero_badge');
            $table->string('hero_subtitle')->nullable()->after('hero_title');
            $table->text('hero_description')->nullable()->after('hero_subtitle');
            $table->string('categories_title')->nullable()->after('hero_description');
            $table->text('categories_description')->nullable()->after('categories_title');
            $table->string('featured_title')->nullable()->after('categories_description');
            $table->text('featured_description')->nullable()->after('featured_title');
            $table->string('trending_title')->nullable()->after('featured_description');
            $table->text('trending_description')->nullable()->after('trending_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'hero_badge',
                'hero_title',
                'hero_subtitle',
                'hero_description',
                'categories_title',
                'categories_description',
                'featured_title',
                'featured_description',
                'trending_title',
                'trending_description',
            ]);
        });
    }
};
