<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Tool extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'icon',
        'component_name',
        'tool_type',
        'configuration',
        'is_active',
        'is_featured',
        'order',
        'views',
        'usage_count',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_markup',
        'content',
    ];

    protected $casts = [
        'configuration' => 'array',
        'schema_markup' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'order' => 'integer',
        'view_count' => 'integer',
        'usage_count' => 'integer',
    ];

    /**
     * Get the category that owns the tool.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the analytics for the tool.
     */
    public function analytics(): HasMany
    {
        return $this->hasMany(ToolAnalytic::class);
    }

    /**
     * Get related tools from the same category.
     */
    public function relatedTools($limit = 6)
    {
        return Cache::remember("tool.{$this->id}.related", 3600, function () use ($limit) {
            return static::where('category_id', $this->category_id)
                ->where('id', '!=', $this->id)
                ->where('is_active', true)
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        });
    }

    /**
     * Increment view count.
     */
    public function incrementViews(): void
    {
        $this->increment('view_count');
        Cache::forget("tool.{$this->id}.related");
    }

    /**
     * Increment usage count.
     */
    public function incrementUsage(): void
    {
        $this->increment('usage_count');
    }

    /**
     * Scope a query to only include active tools.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured tools.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order by order column.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Scope a query to order by popularity.
     */
    public function scopePopular($query)
    {
        return $query->orderByDesc('usage_count');
    }
}
