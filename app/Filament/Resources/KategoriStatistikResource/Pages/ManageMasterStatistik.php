<?php

namespace App\Filament\Resources\KategoriStatistikResource\Pages;

use App\Filament\Resources\KategoriStatistikResource;
use Filament\Resources\Pages\Page;

class ManageMasterStatistik extends Page
{
    protected static string $resource = KategoriStatistikResource::class;

    protected string $view = 'filament.resources.kategori-statistik-resource.pages.manage-master-statistik';

    public function getTitle(): string
    {
        return 'Kategori Statistik';
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }
}
