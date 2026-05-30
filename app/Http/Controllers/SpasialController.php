<?php

namespace App\Http\Controllers;

use App\Models\InputDataSpasial;
use App\Models\KategoriSpasial;
use Illuminate\View\View;

class SpasialController extends Controller
{
    /**
     * Halaman peta spasial interaktif.
     */
    public function index(): View
    {
        $categories = KategoriSpasial::where('is_active', true)
            ->withCount(['spasial' => fn ($q) => $q->where('is_active', true)])
            ->get();

        $spatials = InputDataSpasial::where('is_active', true)
            ->with('kategori')
            ->get();

        // Format data sebagai GeoJSON FeatureCollection untuk Leaflet
        $geoJson = [
            'type'     => 'FeatureCollection',
            'features' => $spatials->map(fn ($s) => $s->toGeoJsonFeature())->values()->toArray(),
        ];

        return view('spasial.index', compact('categories', 'spatials', 'geoJson'));
    }
}
