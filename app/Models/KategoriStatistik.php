<?php
// app/Models/KategoriStatistik.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriStatistik extends Model
{
    protected $table    = 'kategori_statistik';
    protected $fillable = ['judul_kategori', 'slug', 'logo_kategori', 'user_id', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
 
    protected static function booted(): void
    {
        static::creating(function (KategoriStatistik $model) {
            if (empty($model->slug)) {
                $model->slug = \Illuminate\Support\Str::slug($model->judul_kategori);
            }
        });
    }

    // Compatibility accessor for portal views
    public function getNameAttribute(): string { return $this->judul_kategori; }
    public function getIconAttribute(): ?string { return $this->logo_kategori; }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tabelStatistik(): HasMany
    {
        return $this->hasMany(TabelStatistik::class, 'kategori_id');
    }

    public function statistics(): HasMany
    {
        return $this->tabelStatistik();
    }

    public function infografis(): HasMany
    {
        return $this->hasMany(InputInfografis::class, 'kategori_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_kategori ? asset('storage/' . $this->logo_kategori) : null;
    }
}
