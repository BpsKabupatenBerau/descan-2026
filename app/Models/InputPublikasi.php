<?php
// app/Models/InputPublikasi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class InputPublikasi extends Model
{
    protected $table    = 'input_publikasi';
    protected $fillable = [
        'judul_publikasi', 'slug', 'deskripsi_publikasi',
        'kategori_publikasi_id', 'tahun_id', 'penulis',
        'file_publikasi', 'nama_file_unduhan', 'ukuran_file',
        'download_count', 'is_active', 'user_id',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'download_count' => 'integer',
        'ukuran_file'    => 'integer',
    ];

    // Compatibility accessors for portal views
    public function getTitleAttribute(): string { return $this->judul_publikasi; }
    public function getCategoryAttribute(): ?string { return $this->kategoriPublikasi?->kategori; }
    public function getPublishedDateAttribute() { return $this->created_at; }
    public function getFileSizeHumanAttribute(): string { return $this->ukuran_file_terbaca; }
    public function getDescriptionAttribute(): ?string { return $this->deskripsi_publikasi; }
    public function getDataYearAttribute(): ?string { return $this->tahun?->tahun; }        // alias for view
    public function getAuthorAttribute(): ?string { return $this->penulis; }                // alias for view

    protected static function booted(): void
    {
        static::creating(function (InputPublikasi $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul_publikasi);
            }
        });
    }

    public function kategoriPublikasi(): BelongsTo
    {
        return $this->belongsTo(KategoriPublikasi::class, 'kategori_publikasi_id');
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
        return asset('storage/' . $this->file_publikasi);
    }

    /**
     * Human-readable file size for display.
     */
    public function getUkuranFileTerbacaAttribute(): string
    {
        $bytes = $this->ukuran_file ?? 0;
        if ($bytes < 1024)        return $bytes . ' B';
        if ($bytes < 1_048_576)   return round($bytes / 1024, 1) . ' KB';
        if ($bytes < 1_073_741_824) return round($bytes / 1_048_576, 1) . ' MB';
        return round($bytes / 1_073_741_824, 2) . ' GB';
    }

    /**
     * Increment download counter atomically.
     */
    public function incrementDownload(): void
    {
        $this->increment('download_count');
    }
}
