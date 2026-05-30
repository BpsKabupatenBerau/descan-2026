<?php

namespace App\Filament\Resources\InputDataSpasialResource\Pages;

use App\Filament\Resources\InputDataSpasialResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateInputDataSpasial extends CreateRecord
{
    protected static string $resource = InputDataSpasialResource::class;

    protected static bool $canCreateAnother = false;

    protected Width | string | null $maxContentWidth = Width::Full;

    public function getTitle(): string
    {
        return 'Tambah Lokasi Baru';
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
