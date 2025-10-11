<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    protected $fillable = [
        'value',
        'label',
        'city',
        'country',
        'region',
        'is_popular',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope for active timezones
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for popular timezones
     */
    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }

    /**
     * Scope for ordered timezones
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('label');
    }

    /**
     * Scope by region
     */
    public function scopeByRegion($query, $region)
    {
        return $query->where('region', $region);
    }
}
