<?php

namespace App\Filament\Resources\InputPublikasiResource\Pages;

use App\Filament\Resources\InputPublikasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateInputPublikasi extends CreateRecord
{
    protected static string $resource = InputPublikasiResource::class;

    protected static bool $canCreateAnother = false;

    protected Width | string | null $maxContentWidth = Width::Full;

    public function getTitle(): string
    {
        return 'Upload Publikasi Baru';
    }

    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()->label('Simpan Data');
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()->label('Batal');
    }

}
