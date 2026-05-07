<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class StatisticCategory extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'icon',
        'parent_id', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(StatisticCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(StatisticCategory::class, 'parent_id')->orderBy('order');
    }

    public function statistics(): HasMany
    {
        return $this->hasMany(Statistic::class, 'category_id')->orderBy('order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }
}
