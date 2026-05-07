<?php
// app/Models/InputInfografis.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class InputInfografis extends Model
{
    protected $table    = 'input_infografis';
    protected $fillable = [
        'judul_infografis', 'slug', 'deskripsi_infografis',
        'kategori_id', 'tahun_id', 'sumber',
        'file_infografis', 'is_active', 'user_id',
    ];

    protected $casts = ['is_active' => 'boolean'];

    protected static function booted(): void
    {
        static::creating(function (InputInfografis $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul_infografis);
            }
        });
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriStatistik::class, 'kategori_id');
    }

    public function tahun(): BelongsTo
    {
        return $this->belongsTo(Tahun::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file_infografis);
    }
}
