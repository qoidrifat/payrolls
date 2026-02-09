<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TunjanganResource\Pages;
use App\Models\Tunjangan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TunjanganResource extends Resource
{
    protected static ?string $model = Tunjangan::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('jenis_tunjangan')
                    ->label('Jenis Tunjangan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nominal')
                    ->label('Nominal')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jenis_tunjangan')
                    ->label('Jenis Tunjangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->label('Nominal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah Pada')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Added delete action
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPluralLabel(): ?string
    {
        return 'Tunjangan Karyawan';
    }

    public static function getLabel(): ?string
    {
        return 'Tunjangan Karyawan';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTunjangans::route('/'),
            'create' => Pages\CreateTunjangan::route('/create'),
            'edit' => Pages\EditTunjangan::route('/{record}/edit'),
        ];
    }
}
