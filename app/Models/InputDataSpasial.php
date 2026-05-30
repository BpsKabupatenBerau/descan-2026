<?php
// app/Models/InputDataSpasial.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InputDataSpasial extends Model
{
    protected $table    = 'input_data_spasial';
    protected $fillable = [
        'kategori_id', 'nama_lokasi', 'deskripsi', 'alamat_lengkap',
        'telepon', 'website', 'latitude', 'longitude',
        'extra_data', 'is_active', 'user_id',
    ];

    protected $casts = [
        'latitude'   => 'float',
        'longitude'  => 'float',
        'extra_data' => 'array',  // PostgreSQL JSONB auto-decoded
        'is_active'  => 'boolean',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriSpasial::class, 'kategori_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Serialize to GeoJSON Feature for Leaflet.js map.
     * Called in SpasialController to build FeatureCollection.
     */
    public function toGeoJsonFeature(): array
    {
        return [
            'type'     => 'Feature',
            'geometry' => [
                'type'        => 'Point',
                'coordinates' => [$this->longitude, $this->latitude],
                // GeoJSON order is [lng, lat] — NOT [lat, lng]
            ],
            'properties' => [
                'id'          => $this->id,
                'category_id' => $this->kategori_id,
                'name'        => $this->nama_lokasi,
                'description' => $this->deskripsi,
                'address'     => $this->alamat_lengkap,
                'phone'       => $this->telepon,
                'category'    => $this->kategori?->judul_kategori,
                'color'       => $this->kategori?->warna_marker ?? '#3B82F6',
                'extra_data'  => $this->extra_data,
            ],
        ];
    }
}
