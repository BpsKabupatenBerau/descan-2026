<?php

namespace App\Filament\Resources\InputDataSpasialResource\Pages;

use App\Filament\Resources\InputDataSpasialResource;
use App\Filament\Widgets\SpasialStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInputDataSpasial extends ListRecords
{
    protected static string $resource = InputDataSpasialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('+ Tambah Lokasi'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SpasialStatsWidget::class,
        ];
    }
}
