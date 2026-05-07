<?php
// app/Models/KategoriStatistik.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriStatistik extends Model
{
    protected $table    = 'kategori_statistik';
    protected $fillable = ['judul_kategori', 'logo_kategori', 'user_id', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tabelStatistik(): HasMany
    {
        return $this->hasMany(TabelStatistik::class, 'kategori_id');
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
