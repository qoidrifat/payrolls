<?php

namespace App\Filament\Karyawan\Resources\PenggajiansResource\Pages;

use App\Filament\Karyawan\Resources\PenggajiansResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenggajians extends EditRecord
{
    protected static string $resource = PenggajiansResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
