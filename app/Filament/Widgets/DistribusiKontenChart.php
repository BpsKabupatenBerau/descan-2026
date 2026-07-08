<?php

namespace App\Filament\Widgets;

// Import semua model yang digunakan untuk menghitung data konten
use App\Models\Statistik;
use App\Models\Infografis;
use App\Models\Spasial; // Sesuaikan dengan nama Model Spasial/Peta Anda
use App\Models\Publikasi;
use Filament\Widgets\ChartWidget;

class DistribusiKontenChart extends ChartWidget
{
    // Mengambil porsi 1 dari 3 kolom (Lebar 1/3)
    protected int|string|array $columnSpan = 1;

    protected ?string $heading = "Distribusi Konten";

    protected function getData(): array
    {
        // 1. Ambil data riil secara dinamis menggunakan count() dari masing-masing tabel
        $totalStatistik = Statistik::count();
        $totalInfografis = Infografis::count();
        $totalSpasial = Spasial::count(); // Pastikan nama model ini sudah benar
        $totalPublikasi = Publikasi::count();

        return [
            "datasets" => [
                [
                    "label" => "Total",
                    // 2. Masukkan variabel hasil hitungan ke dalam array data chart
                    "data" => [
                        $totalStatistik,
                        $totalInfografis,
                        $totalSpasial,
                        $totalPublikasi,
                    ],
                    "backgroundColor" => [
                        "#3b82f6", // Biru untuk Statistik
                        "#10b981", // Hijau untuk Infografis
                        "#f59e0b", // Kuning untuk Spasial
                        "#ef4444", // Merah untuk Publikasi
                    ],
                ],
            ],
            "labels" => ["Statistik", "Infografis", "Spasial", "Publikasi"],
        ];
    }

    protected function getType(): string
    {
        return "doughnut";
    }

    // Opsi tambahan untuk mempercantik chart
    protected function getOptions(): array
    {
        return [
            "cutout" => "70%", // Membuat lubang tengah donat menjadi lebih besar seperti gambar
            "plugins" => [
                "legend" => [
                    "position" => "right", // Memindahkan posisi label warna ke sebelah kanan chart
                ],
            ],
        ];
    }
}
