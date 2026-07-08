<?php

namespace App\Filament\Resources\KategoriSpasials\Schemas;

use App\Models\KategoriSpasial;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class KategoriSpasialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make("Informasi Kategori")
                ->schema([
                    TextInput::make("judul")
                        ->label("Judul Kategori")
                        ->placeholder("Contoh: Kependudukan")
                        ->required()
                        ->maxLength(255),

                    FileUpload::make("logo")
                        ->label("Logo")
                        ->image()
                        ->avatar() // Mengubah tampilan upload menjadi bulat seperti di gambar
                        ->directory("kategori-spasial"),
                    // ->buttonLa/bel("Ganti Logo"),

                    Toggle::make("status")
                        ->label("Aktif")
                        ->helperText("Centang untuk menampilkan di website")
                        ->default(true)
                        ->onColor("success"),
                ])
                ->columnSpan([
                    "lg" => fn(?KategoriSpasial $record) => $record === null
                        ? 2
                        : 2,
                ]),
            // Membuat lebar form lebih proporsional seperti pada desain
        ]);
    }
}
