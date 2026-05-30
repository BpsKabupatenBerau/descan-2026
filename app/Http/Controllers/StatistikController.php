<?php

namespace App\Http\Controllers;

use App\Models\KategoriStatistik;
use App\Models\TabelStatistik;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StatistikController extends Controller
{
    /**
     * Halaman daftar semua kategori statistik.
     */
    public function index(): View
    {
        $categories = KategoriStatistik::active()
            ->with(['tabelStatistik' => fn ($q) => $q->active()])
            ->get();

        return view('statistik.index', compact('categories'));
    }

    /**
     * Halaman daftar statistik dalam satu kategori.
     */
    public function category(string $slug): View|RedirectResponse
    {
        $category = KategoriStatistik::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $statistics = $category->tabelStatistik()
            ->active()
            ->get();

        // Semua kategori untuk sidebar
        $allCategories = KategoriStatistik::active()
            ->get();

        return view('statistik.index', compact('category', 'statistics', 'allCategories'));
    }

    /**
     * Halaman detail satu statistik (dengan chart/tabel).
     */
    public function show(string $catSlug, string $slug): View
    {
        $category = KategoriStatistik::where('slug', $catSlug)
            ->where('is_active', true)
            ->firstOrFail();

        $statistic = $category->tabelStatistik()
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        // Siblings — semua statistik dalam kategori yang sama (untuk sidebar)
        $siblings = $category->tabelStatistik()
            ->active()
            ->get();

        // Breadcrumb
        $breadcrumb = [
            ['label' => 'Statistik', 'url' => route('statistik.index')],
            ['label' => $category->judul_kategori, 'url' => route('statistik.category', $catSlug)],
            ['label' => $statistic->judul_tabel, 'url' => null],
        ];

        return view('statistik.show', compact('category', 'statistic', 'siblings', 'breadcrumb'));
    }
}
