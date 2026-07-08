<?php

namespace App\Filament\Resources\Statistiks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

class StatistikForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            // 1. Kategori (Dropdown)
            Select::make("kategori")
                ->label("Kategori")
                ->placeholder("-- Pilih Kategori --")
                ->options([
                    "Kependudukan" => "Kependudukan",
                    "Sarana" => "Sarana",
                    "Ekonomi" => "Ekonomi",
                    "Lainnya" => "Lainnya",
                ])
                ->required()
                ->searchable(),

            // 2. Judul Tabel (Dropdown / Teks - Sesuaikan kebutuhan)
            Select::make("judul")
                ->label("Judul Tabel")
                ->placeholder("-- Pilih Tabel Statistik --")
                ->options([
                    "Total Penduduk" => "Total Penduduk",
                    "Kepadatan Penduduk" => "Kepadatan Penduduk",
                ])
                ->required()
                ->searchable(),

            // 3. Periode Data - Tahun (Dropdown)
            Select::make("tahun_terkini")
                ->label("Periode Data")
                ->placeholder("-- Pilih Tahun --")
                ->options(
                    array_combine(
                        range(date("Y"), 2000),
                        range(date("Y"), 2000),
                    ),
                )
                ->required(),

            // 4. Periode Data - Bulan Opsional (Dropdown)
            Select::make("bulan")
                ->label("") // Label kosong karena di gambar posisinya di bawah Tahun langsung
                ->placeholder(
                    "-- Pilih Bulan (Apabila data terkecilnya bulan) --",
                )
                ->options([
                    "01" => "Januari",
                    "02" => "Februari",
                    "03" => "Maret",
                    "04" => "April",
                    "05" => "Mei",
                    "06" => "Juni",
                    "07" => "Juli",
                    "08" => "Agustus",
                    "09" => "September",
                    "10" => "Oktobeer",
                    "11" => "November",
                    "12" => "Desember",
                ]),

            // 5. Status Aktif (Menggunakan Toggle Saklar sesuai gambar)
            Toggle::make("status")
                ->label("Aktif")
                ->helperText("Tampilkan di halaman publik")
                ->default(true)
                ->onColor("success"),

            // 6. Upload Excel (File Upload)
            FileUpload::make("file_excel")
                ->label("Upload Excel")
                ->acceptedFileTypes([
                    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                    "application/vnd.ms-excel",
                ])
                ->maxSize(10240) // Maksimal 10 MB sesuai teks di gambar
                ->placeholder("Drag & drop excel di sini atau Pilih File")
                ->required(),
        ]);
    }
}
