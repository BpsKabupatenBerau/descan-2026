<?php
// app/Models/TabelStatistik.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TabelStatistik extends Model
{
    protected $table    = 'tabel_statistik';
    protected $fillable = [
        'judul_tabel', 'slug', 'kategori_id', 'baris_tabel_ke', 'tipe_chart',
        'sumber_data', 'satuan_id', 'periode_data', 'is_active', 'user_id',
        'deskripsi', 'nama_baris'
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'nama_baris' => 'array',
    ];

    // Compatibility accessors for portal views
    public function getTitleAttribute(): string { return $this->judul_tabel; }
    public function getSummaryValueAttribute(): ?string { return $this->toKpiValue(); }
    public function getUnitAttribute(): ?string { return $this->satuan?->nama_satuan; }
    public function getDataYearAttribute(): ?string { return $this->inputData()->orderByDesc('tahun_id')->first()?->tahun?->tahun; }
    public function getSummaryLabelAttribute(): ?string { return $this->judul_tabel; }
    public function getSourceAttribute(): ?string { return $this->sumber_data; }           // alias for view
    public function getDescriptionAttribute(): ?string { return $this->sumber_data; }      // alias for view

    // Auto-generate slug on create
    protected static function booted(): void
    {
        static::creating(function (TabelStatistik $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul_tabel);
            }
        });
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriStatistik::class, 'kategori_id');
    }

    public function satuan(): BelongsTo
    {
        return $this->belongsTo(SatuanStatistik::class, 'satuan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inputData(): HasMany
    {
        return $this->hasMany(InputDataTabel::class, 'tabel_statistik_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Build Chart.js-compatible data structure from input rows.
     * Groups rows by label, then by year.
     *
     * Returns: ['labels' => [...], 'datasets' => [['label' => year, 'data' => [...]]]]
     */
    public function toChartJsData(): array
    {
        $rows = $this->inputData()
            ->where('is_active', true)
            ->with('tahun')
            ->orderBy('tahun_id')
            ->get();

        if ($rows->isEmpty()) {
            return ['labels' => [], 'datasets' => []];
        }

        // Group by tahun, then by label_baris
        $grouped = $rows->groupBy(fn($r) => $r->tahun->tahun ?? '?');
        $labels  = $rows->pluck('label_baris')->unique()->filter()->values()->toArray();

        $palette = [
            '#3B82F6','#10B981','#F59E0B','#EF4444',
            '#8B5CF6','#06B6D4','#F97316','#14B8A6',
        ];

        $datasets = [];
        $i = 0;
        foreach ($grouped as $year => $yearRows) {
            $data = [];
            foreach ($labels as $label) {
                $row = $yearRows->firstWhere('label_baris', $label);
                $data[] = $row ? (float) $row->nilai : 0;
            }
            $col = $palette[$i % count($palette)];
            $datasets[] = [
                'label'           => (string) $year,
                'data'            => $data,
                'backgroundColor' => $col,
                'borderColor'     => $col,
            ];
            $i++;
        }

        return ['labels' => $labels, 'datasets' => $datasets];
    }

    /**
     * For chart_type = 'number': return latest single value.
     */
    public function toKpiValue(): ?string
    {
        $latest = $this->inputData()
            ->where('is_active', true)
            ->orderByDesc('tahun_id')
            ->first();

        return $latest ? number_format((float) $latest->nilai, 0, ',', '.') : null;
    }
}
