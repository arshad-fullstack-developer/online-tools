<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
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
        'order',
        'is_active',
        'show_in_menu',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'schema_markup',
        'view_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_in_menu' => 'boolean',
        'view_count' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Increment view count
     */
    public function incrementViews(): void
    {
        $this->increment('view_count');
    }

    /**
     * Scope for active pages
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for menu pages
     */
    public function scopeInMenu($query)
    {
        return $query->where('show_in_menu', true);
    }

    /**
     * Scope for ordered pages
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Get SEO data
     */
    public function getSeoData(): array
    {
        return [
            'title' => $this->meta_title ?: $this->title,
            'description' => $this->meta_description ?: $this->excerpt,
            'keywords' => $this->meta_keywords ?: '',
            'og_image' => $this->og_image ?: $this->featured_image,
            'schema_markup' => $this->schema_markup,
        ];
    }
}
