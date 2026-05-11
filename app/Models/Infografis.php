<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Infografis extends Model
{
    protected $table = 'infografis';

    protected $fillable = [
        'title', 'slug', 'description',
        'image_path', 'data_year', 'category',
        'source', 'is_active', 'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'data_year' => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn ($m) => $m->slug = $m->slug ?? Str::slug($m->title));
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}
