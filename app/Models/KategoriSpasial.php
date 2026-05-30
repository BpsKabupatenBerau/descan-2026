<?php
// app/Models/KategoriSpasial.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriSpasial extends Model
{
    protected $table    = 'kategori_spasial';
    protected $fillable = ['judul_kategori', 'warna_marker', 'logo_kategori', 'user_id', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    // Compatibility accessors for portal views
    public function getNameAttribute(): string { return $this->judul_kategori; }
    public function getColorAttribute(): string { return $this->warna_marker ?? '#3B82F6'; }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function spasial(): HasMany
    {
        return $this->hasMany(InputDataSpasial::class, 'kategori_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
