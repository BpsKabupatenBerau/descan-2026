<?php

namespace App\Filament\Resources\Infografis\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid; // Pastikan namespace menggunakan Forms
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

class InfografisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(12)->schema([
                // --- KIRI: Informasi Infografis ---
                Section::make("Informasi Infografis")
                    ->columnSpan(7)
                    ->schema([
                        TextInput::make("judul")
                            ->label("Judul")
                            ->placeholder("Contoh: Piramida Penduduk 2024")
                            ->required(),

                        Textarea::make("deskripsi")
                            ->label("Deskripsi")
                            ->placeholder("Keterangan singkat...")
                            ->rows(3), // Memperlebar area teks

                        TextInput::make("kategori")
                            ->label("Kategori")
                            ->placeholder("Kependudukan / Kesehatan / dll")
                            ->required(),

                        TextInput::make("tahun")
                            ->label("Tahun Data")
                            ->placeholder("2024")
                            ->numeric()
                            ->required(),

                        TextInput::make("sumber")
                            ->label("Sumber")
                            ->placeholder("Contoh: Disdukcapil 2024")
                            ->required(),

                        Toggle::make("status")
                            ->label("Aktif")
                            ->helperText("Tampilkan di halaman publik") // Tambahan teks kecil di bawah toggle
                            ->default(true)
                            ->onColor("success"),
                    ]),

                // --- KANAN: Upload Gambar ---
                Grid::make(1)
                    ->columnSpan(5)
                    ->schema([
                        Section::make("Upload Gambar")->schema([
                            FileUpload::make("file_gambar")
                                ->hiddenLabel() // Label utama disembunyikan karena judul sudah ada di Section
                                ->image()
                                ->directory("infografis")
                                ->placeholder(
                                    "Drag & drop gambar di sini atau Pilih File",
                                )
                                ->acceptedFileTypes([
                                    "image/jpeg",
                                    "image/png",
                                    "image/webp",
                                ]) // Format: JPG, PNG, WebP
                                ->maxSize(10240) // Maks 10 MB
                                ->required(),
                        ]),

                        /*
                         * Catatan: Kotak "Pratinjau Gambar" di bawahnya tidak perlu
                         * dibuat secara terpisah, karena komponen `FileUpload` Filament
                         * secara bawaan akan memunculkan pratinjau gambar tepat
                         * di bawah kotaknya setelah gambar berhasil dipilih/diunggah.
                         */
                    ]),
            ]),
        ]);
    }
}
