<?php

namespace App\Filament\Resources\Spasials\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Components\Grid;

class SpasialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(12)->schema([
                // --- KIRI: Informasi Lokasi ---
                Section::make("Informasi Lokasi")
                    ->columnSpan(7)
                    ->schema([
                        Select::make("kategori")
                            ->placeholder("-- Pilih Kategori --")
                            ->options([
                                "Pemerintahan" => "Pemerintahan",
                                "Kesehatan" => "Kesehatan",
                                "Pendidikan" => "Pendidikan",
                                "Sarana Ibadah" => "Sarana Ibadah",
                                "Perbankan" => "Perbankan",
                                "Olahraga" => "Olahraga",
                            ])
                            ->required(),
                        TextInput::make("nama_lokasi")
                            ->placeholder("Contoh: Puskesmas Desa Contoh")
                            ->required(),
                        Textarea::make("deskripsi")
                            ->placeholder(
                                "Keterangan singkat tentang lokasi...",
                            )
                            ->rows(3),
                        TextInput::make("alamat_lengkap")
                            ->placeholder("Jl. Contoh No. 1, Dusun I")
                            ->required(),
                        TextInput::make("telepon")->placeholder(
                            "+62 812-xxxx-xxxx",
                        ),
                        TextInput::make("website")->placeholder("https://"),
                        Toggle::make("status")
                            ->label("Aktif")
                            ->default(true)
                            ->onColor("success"),
                    ]),

                // --- KANAN: Koordinat & Data Tambahan ---
                Grid::make(1)
                    ->columnSpan(5)
                    ->schema([
                        Section::make("Koordinat GPS")->schema([
                            TextInput::make("latitude")
                                ->label("Latitude (Lintang)")
                                ->placeholder("-1.2379")
                                ->required(),
                            TextInput::make("longitude")
                                ->label("Longitude (Bujur)")
                                ->placeholder("116.8529")
                                ->required(),
                        ]),

                        Section::make("Data Tambahan (Opsional)")->schema([
                            // Menggunakan KeyValue agar user bisa bebas menambah "Jam Operasional" atau "Fasilitas" sesuai UI
                            KeyValue::make("data_tambahan")
                                ->keyLabel("Field")
                                ->valueLabel("Nilai")
                                ->addActionLabel("+ Tambah Field"),
                        ]),
                    ]),
            ]),
        ]);
    }
}
