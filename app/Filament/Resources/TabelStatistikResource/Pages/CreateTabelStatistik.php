<?php

namespace App\Filament\Resources\TabelStatistikResource\Pages;

use App\Filament\Resources\TabelStatistikResource;
use App\Models\InputDataTabel;
use Filament\Resources\Pages\CreateRecord;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class CreateTabelStatistik extends CreateRecord
{
    protected static string $resource = TabelStatistikResource::class;

    public function getTitle(): string
    {
        return 'Tambah Statistik Baru';
    }

    /**
     * Before creating, extract virtual fields (tahun_id, bulan_id, file_excel)
     * from the form data so they aren't passed to TabelStatistik::create().
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Store virtual fields on the component so we can use them after create
        $this->tahunId  = $data['tahun_id'] ?? null;
        $this->bulanId  = $data['bulan_id'] ?? null;
        $this->fileExcel = $data['file_excel'] ?? null;

        // Remove virtual fields so they don't cause DB errors
        unset($data['tahun_id'], $data['bulan_id'], $data['file_excel']);

        return $data;
    }

    /**
     * After TabelStatistik is created, parse Excel and create InputDataTabel rows.
     */
    protected function afterCreate(): void
    {
        $record   = $this->record;
        $tahunId  = $this->tahunId ?? null;
        $bulanId  = $this->bulanId ?? null;
        $filePath = $this->fileExcel ?? null;

        if ($filePath && $tahunId) {
            $absolutePath = Storage::disk('public')->path($filePath);

            if (file_exists($absolutePath)) {
                $sheets = Excel::toArray(new \stdClass(), $absolutePath);

                if (!empty($sheets[0])) {
                    $rows = $sheets[0];

                    foreach ($rows as $index => $row) {
                        // Skip header row (index 0)
                        if ($index === 0) continue;

                        $label = isset($row[0]) ? trim((string) $row[0]) : null;
                        $nilai = $row[1] ?? null;

                        if ($label !== null && $label !== '') {
                            InputDataTabel::create([
                                'tabel_statistik_id' => $record->id,
                                'kategori_id'        => $record->kategori_id,
                                'tahun_id'           => $tahunId,
                                'bulan_id'           => $bulanId,
                                'label_baris'        => $label,
                                'nilai'              => is_numeric($nilai) ? (float) $nilai : null,
                                'is_active'          => true,
                            ]);
                        }
                    }
                }
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
