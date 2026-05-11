<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Spatial extends Model
{
    protected $fillable = [
        'category_id', 'name', 'description', 'address',
        'latitude', 'longitude', 'phone', 'website',
        'extra_data', 'is_active',
    ];

    protected $casts = [
        'latitude'   => 'float',
        'longitude'  => 'float',
        'extra_data' => 'array',
        'is_active'  => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(SpatialCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Return GeoJSON Feature representation for Leaflet.
     */
    public function toGeoJsonFeature(): array
    {
        return [
            'type' => 'Feature',
            'geometry' => [
                'type'        => 'Point',
                'coordinates' => [$this->longitude, $this->latitude],
            ],
            'properties' => [
                'id'          => $this->id,
                'name'        => $this->name,
                'description' => $this->description,
                'address'     => $this->address,
                'phone'       => $this->phone,
                'category'    => $this->category?->name,
                'color'       => $this->category?->color ?? '#3B82F6',
                'icon'        => $this->category?->icon,
            ],
        ];
    }
}
