<?php

namespace App\Filament\Resources\PenggajianResource\Pages;

use App\Filament\Resources\PenggajianResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePenggajian extends CreateRecord
{
    protected static string $resource = PenggajianResource::class;

    // Mutasi data form sebelum disimpan
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Hitung gaji bersih sebelum menyimpan ke database
        $penggajian = new \App\Models\Penggajian($data);
        $data['gaji_bersih'] = $penggajian->hitungGajiBersih();

        return $data;
    }
}
