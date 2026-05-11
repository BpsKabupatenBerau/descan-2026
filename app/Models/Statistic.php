<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Statistic extends Model
{
    protected $fillable = [
        'category_id', 'title', 'slug', 'description',
        'source', 'data_year', 'unit',
        'chart_type', 'chart_data',
        'summary_value', 'summary_label',
        'is_active', 'order',
    ];

    protected $casts = [
        'chart_data' => 'array',
        'is_active'  => 'boolean',
        'data_year'  => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(StatisticCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Return chart_data formatted for Chart.js
     * Expected structure:
     * {
     *   "labels": ["Label1", "Label2"],
     *   "datasets": [
     *     { "label": "Series Name", "data": [10, 20], "backgroundColor": ["#3B82F6"] }
     *   ]
     * }
     */
    public function getChartJsData(): array
    {
        return $this->chart_data ?? ['labels' => [], 'datasets' => []];
    }
}
