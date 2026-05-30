<?php

namespace App\Filament\Resources\KategoriSpasialResource\Pages;

use App\Filament\Resources\KategoriSpasialResource;
use Filament\Resources\Pages\Page;

class ListKategoriSpasial extends Page
{
    protected static string $resource = KategoriSpasialResource::class;

    protected string $view = 'filament.resources.kategori-spasial-resource.pages.list-kategori-spasial';

    public function getTitle(): string
    {
        return 'Kategori Spasial';
    }
}
