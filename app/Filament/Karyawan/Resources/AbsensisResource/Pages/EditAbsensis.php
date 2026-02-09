<?php

namespace App\Filament\Karyawan\Resources\AbsensisResource\Pages;

use App\Filament\Karyawan\Resources\AbsensisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAbsensis extends EditRecord
{
    protected static string $resource = AbsensisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
