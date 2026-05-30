<?php

namespace App\Http\Controllers;

use App\Models\InputPublikasi;
use App\Models\KategoriPublikasi;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PublikasiController extends Controller
{
    public function index(Request $request): View
    {
        $query = InputPublikasi::where('is_active', true)
            ->with(['kategoriPublikasi', 'tahun'])
            ->latest();

        // Match view parameters: 'cari', 'kategori', and 'tahun'
        if ($request->filled('cari')) {
            $query->where('judul_publikasi', 'like', '%' . $request->cari . '%');
        }

        if ($request->filled('kategori')) {
            $query->whereHas('kategoriPublikasi', fn($q) => $q->where('kategori', $request->kategori));
        }

        if ($request->filled('tahun')) {
            $query->whereHas('tahun', fn($q) => $q->where('tahun', $request->tahun));
        }

        $publications = $query->paginate(10)->withQueryString();

        // Distinct kategori untuk filter
        $categories = KategoriPublikasi::orderBy('kategori')->pluck('kategori');

        // Distinct tahun
        $years = Tahun::orderByDesc('tahun')->pluck('tahun');

        return view('publikasi.index', compact('publications', 'categories', 'years'));
    }

    public function download(string $slug): StreamedResponse|RedirectResponse
    {
        $pub = InputPublikasi::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Increment download counter
        $pub->incrementDownload();

        // Cek file di storage/public
        if ($pub->file_publikasi && Storage::disk('public')->exists($pub->file_publikasi)) {
            $filename = ($pub->nama_file_unduhan ?? \Str::slug($pub->judul_publikasi)) . '.pdf';

            return Storage::disk('public')->download($pub->file_publikasi, $filename);
        }

        // Fallback: use getFileUrlAttribute()
        return redirect()->away($pub->file_url);
    }
}
