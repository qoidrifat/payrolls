<?php

namespace App\Filament\Karyawan\Resources\AbsensisResource\Pages;

use App\Filament\Karyawan\Resources\AbsensisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAbsenses extends ListRecords
{
    protected static string $resource = AbsensisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
