<?php

namespace App\Filament\Resources\KategoriSpasialResource\Pages;

use App\Filament\Resources\KategoriSpasialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriSpasial extends EditRecord
{
    protected static string $resource = KategoriSpasialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
