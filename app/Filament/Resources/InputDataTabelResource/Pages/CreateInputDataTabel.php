<?php

namespace App\Filament\Resources\InputDataTabelResource\Pages;

use App\Filament\Resources\InputDataTabelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class CreateInputDataTabel extends CreateRecord
{
    protected static string $resource = InputDataTabelResource::class;

    protected static bool $canCreateAnother = false;

    protected Width | string | null $maxContentWidth = Width::Full;

    public function getTitle(): string
    {
        return 'Tambah Statistik Baru';
    }

    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()->label('Simpan Data');
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()->label('Batal');
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        if (!empty($data['file_excel'])) {
            $filePath = Storage::disk('public')->path($data['file_excel']);

            // toArray reads the first sheet
            $sheets = Excel::toArray(new \stdClass(), $filePath);
            if (!empty($sheets) && count($sheets) > 0) {
                $rows = $sheets[0];
                $createdModels = [];

                foreach ($rows as $index => $row) {
                    if ($index === 0) continue; // Skip header row

                    $label = $row[0] ?? null;
                    $nilai = $row[1] ?? null;

                    if ($label !== null && trim($label) !== '') {
                        $insertData = $data;
                        $insertData['label_baris'] = $label;
                        $insertData['nilai'] = is_numeric($nilai) ? (float) $nilai : null;
                        unset($insertData['file_excel']);
                        $createdModels[] = static::getModel()::create($insertData);
                    }
                }

                if (count($createdModels) > 0) {
                    return $createdModels[0];
                }
            }
        }

        unset($data['file_excel']);
        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
