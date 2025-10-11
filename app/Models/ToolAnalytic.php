<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ToolAnalytic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tool_id',
        'ip_address',
        'user_agent',
        'country',
        'action_type',
        'metadata',
        'created_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
    ];

    /**
     * Get the tool that owns the analytic.
     */
    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }

    /**
     * Create a new analytic record.
     */
    public static function log(int $toolId, string $actionType, array $metadata = []): void
    {
        static::create([
            'tool_id' => $toolId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action_type' => $actionType,
            'metadata' => $metadata,
            'created_at' => now(),
        ]);
    }
}
