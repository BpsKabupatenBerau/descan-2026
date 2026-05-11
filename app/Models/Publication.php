<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publication extends Model
{
    protected $fillable = [
        'title', 'slug', 'description',
        'file_path', 'file_name', 'file_size',
        'category', 'data_year', 'author',
        'published_date', 'download_count',
        'is_active', 'order',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'data_year'      => 'integer',
        'published_date' => 'date',
        'file_size'      => 'integer',
        'download_count' => 'integer',
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

    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    public function getFileSizeHumanAttribute(): string
    {
        $bytes = $this->file_size ?? 0;
        if ($bytes < 1024) return $bytes . ' B';
        if ($bytes < 1048576) return round($bytes / 1024, 1) . ' KB';
        return round($bytes / 1048576, 1) . ' MB';
    }

    public function incrementDownload(): void
    {
        $this->increment('download_count');
    }
}
