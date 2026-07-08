<?php

namespace App\Filament\Resources\Publikasis\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

class PublikasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(12)->schema([
                // --- KIRI: Informasi Dokumen ---
                Section::make("Informasi Dokumen")
                    ->columnSpan(7)
                    ->schema([
                        TextInput::make("judul")
                            ->placeholder("Contoh: Monografi Desa 2024")
                            ->required(),
                        Textarea::make("deskripsi")
                            ->placeholder("Ringkasan isi dokumen...")
                            ->rows(3),
                        TextInput::make("kategori")
                            ->placeholder("Monografi / Laporan / Perdes / RKPD")
                            ->required(),
                        TextInput::make("tahun")
                            ->label("Tahun Data")
                            ->placeholder("2024")
                            ->numeric()
                            ->required(),
                        TextInput::make("penulis")
                            ->label("Penulis / Penyusun")
                            ->placeholder("Contoh: Sekretaris Desa")
                            ->required(),
                        Toggle::make("status")
                            ->label("Aktif")
                            ->helperText("Tampilkan di halaman publik")
                            ->default(true)
                            ->onColor("success"),
                    ]),

                // --- KANAN: Upload File PDF ---
                Grid::make(1)
                    ->columnSpan(5)
                    ->schema([
                        Section::make("Upload File PDF")->schema([
                            FileUpload::make("file_pdf")
                                ->hiddenLabel()
                                ->acceptedFileTypes(["application/pdf"]) // Hanya menerima PDF
                                ->maxSize(51200) // Maksimal 50 MB
                                ->directory("publikasi_pdf")
                                ->placeholder(
                                    "Drag & drop file PDF di sini atau Pilih PDF",
                                )
                                ->required(),
                        ]),
                    ]),
            ]),
        ]);
    }
}
