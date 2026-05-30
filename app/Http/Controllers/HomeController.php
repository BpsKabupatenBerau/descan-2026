<?php

namespace App\Http\Controllers;

use App\Models\InputInfografis;
use App\Models\InputPublikasi;
use App\Models\TabelStatistik;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // KPI cards: menggunakan TabelStatistik yang aktif
        $kpiStats = TabelStatistik::active()
            ->with(['satuan', 'kategori', 'inputData' => fn($q) => $q->orderByDesc('tahun_id')])
            ->limit(6)
            ->get();

        // Infografis terbaru (4 item)
        $latestInfografis = InputInfografis::where('is_active', true)
            ->with(['kategori', 'tahun'])
            ->latest()
            ->limit(4)
            ->get();

        // Publikasi terbaru (5 item)
        $latestPublications = InputPublikasi::where('is_active', true)
            ->with(['kategoriPublikasi', 'tahun'])
            ->latest()
            ->limit(5)
            ->get();

        return view('home', compact(
            'kpiStats',
            'latestInfografis',
            'latestPublications',
        ));
    }
}
