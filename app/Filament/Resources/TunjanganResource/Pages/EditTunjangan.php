<?php

namespace App\Filament\Resources\TunjanganResource\Pages;

use App\Filament\Resources\TunjanganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTunjangan extends EditRecord
{
    protected static string $resource = TunjanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
