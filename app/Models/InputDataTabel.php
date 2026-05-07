<?php
// app/Models/InputDataTabel.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InputDataTabel extends Model
{
    protected $table    = 'input_data_tabel';
    protected $fillable = [
        'tabel_statistik_id', 'kategori_id', 'tahun_id', 'bulan_id',
        'label_baris', 'nilai', 'file_excel', 'is_active', 'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'nilai'     => 'float',
    ];

    public function tabelStatistik(): BelongsTo
    {
        return $this->belongsTo(TabelStatistik::class, 'tabel_statistik_id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriStatistik::class, 'kategori_id');
    }

    public function tahun(): BelongsTo
    {
        return $this->belongsTo(Tahun::class);
    }

    public function bulan(): BelongsTo
    {
        return $this->belongsTo(Bulan::class)->withDefault();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFileExcelUrlAttribute(): ?string
    {
        return $this->file_excel ? asset('storage/' . $this->file_excel) : null;
    }
}
