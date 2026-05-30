<?php

namespace App\Http\Controllers;

use App\Models\InputInfografis;
use App\Models\KategoriStatistik;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InfografisController extends Controller
{
    public function index(Request $request): View
    {
        $query = InputInfografis::where('is_active', true)
            ->with(['kategori', 'tahun'])
            ->latest();

        // Match view parameters: 'kategori' and 'tahun'
        if ($request->filled('kategori')) {
            $query->whereHas('kategori', fn($q) => $q->where('judul_kategori', $request->kategori));
        }

        if ($request->filled('tahun')) {
            $query->whereHas('tahun', fn($q) => $q->where('tahun', $request->tahun));
        }

        // View expects $items
        $items = $query->paginate(12)->withQueryString();

        // View expects $years and $categories
        $years = Tahun::orderByDesc('tahun')->pluck('tahun');

        $categories = KategoriStatistik::active()
            ->orderBy('judul_kategori')
            ->pluck('judul_kategori');

        return view('infografis.index', compact('items', 'years', 'categories'));
    }

    public function show(string $slug): View
    {
        $item = InputInfografis::where('slug', $slug)
            ->with(['kategori', 'tahun'])
            ->where('is_active', true)
            ->firstOrFail();

        $related = InputInfografis::where('is_active', true)
            ->with(['kategori', 'tahun'])
            ->where('id', '!=', $item->id)
            ->latest()
            ->limit(4)
            ->get();

        return view('infografis.show', compact('item', 'related'));
    }
}
