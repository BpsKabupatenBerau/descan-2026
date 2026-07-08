<?php

namespace App\Filament\Resources\Statistiks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class StatistikForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            // 1. Input Judul (Teks)
            TextInput::make("judul")
                ->label("Judul")
                ->required()
                ->maxLength(255)
                ->placeholder("Contoh: Total Penduduk"),

            // 2. Input Kategori (Dropdown)
            Select::make("kategori")
                ->label("Kategori")
                ->options([
                    "Kependudukan" => "Kependudukan",
                    "Sarana" => "Sarana",
                    "Ekonomi" => "Ekonomi",
                    "Lainnya" => "Lainnya",
                ])
                ->required()
                ->searchable(),

            // 3. Input Tipe Chart (Dropdown)
            Select::make("tipe_chart")
                ->label("Tipe Chart")
                ->options([
                    "number" => "Number (Hanya Angka)",
                    "bar" => "Bar Chart (Grafik Batang)",
                    "doughnut" => "Doughnut Chart (Grafik Donat)",
                    "line" => "Line Chart (Grafik Garis)",
                    "pie" => "Pie Chart (Grafik Pai)",
                ])
                ->required(),

            // 4. Input Tahun Terkini (Angka)
            TextInput::make("tahun_terkini")
                ->label("Tahun Terkini")
                ->numeric()
                ->required()
                ->default(date("Y")) // Default otomatis tahun saat ini
                ->minValue(2000)
                ->maxValue(2100),

            // 5. Input Status (Dropdown)
            Toggle::make("status")
                ->label("Aktif")
                ->helperText("Tampilkan di halaman publik")
                ->default(true)
                ->onColor("success"),
        ]);
    }
}
