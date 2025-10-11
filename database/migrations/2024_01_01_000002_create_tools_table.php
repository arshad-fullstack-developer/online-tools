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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable(); // How to use, FAQ, etc.
            $table->string('icon')->nullable();
            $table->string('component_name'); // Vue component name
            $table->json('input_fields')->nullable(); // Dynamic input structure
            $table->json('output_fields')->nullable(); // Dynamic output structure
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            
            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->json('schema_markup')->nullable(); // Structured data
            
            // Analytics
            $table->bigInteger('view_count')->default(0);
            $table->bigInteger('usage_count')->default(0);
            
            $table->timestamps();
            
            // Indexes
            $table->index('slug');
            $table->index('is_active');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
