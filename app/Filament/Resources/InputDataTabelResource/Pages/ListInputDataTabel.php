<?php

namespace App\Filament\Resources\InputDataTabelResource\Pages;

use App\Filament\Resources\InputDataTabelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInputDataTabel extends ListRecords
{
    protected static string $resource = InputDataTabelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->url(fn() => InputDataTabelResource::getUrl('create', [
                    'tabel_statistik_id' => request()->query('tableFilter')
                ]))
        ];
    }

    public function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getTableQuery();
        if ($tableId = request()->query('tableFilter')) {
            $query->where('tabel_statistik_id', $tableId);
        }
        return $query;
    }
}
