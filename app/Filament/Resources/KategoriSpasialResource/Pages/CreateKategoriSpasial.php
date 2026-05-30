<?php

namespace App\Filament\Resources\KategoriSpasialResource\Pages;

use App\Filament\Resources\KategoriSpasialResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriSpasial extends CreateRecord
{
    protected static string $resource = KategoriSpasialResource::class;

    public function getTitle(): string
    {
        return 'Tambah Kategori Spasial';
    }
}
