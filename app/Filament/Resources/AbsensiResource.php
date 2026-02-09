<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbsensiResource\Pages;
use App\Models\Absensi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // SpatieMediaLibraryFileUpload::make('foto_absensi')
                //     ->image()
                //     ->required()
                //     ->imageEditor()
                //     ->imageCropAspectRatio('1:1')
                //     ->imageResizeTargetWidth(500)
                //     ->imageResizeTargetHeight(500),
                // // Forms\Components\FileUpload::make('foto_absensi'),

                Forms\Components\Select::make('karyawan_id')
                    ->relationship('karyawan', 'nama')
                    ->label('Nama Karyawan')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\DatePicker::make('date')
                    ->label('Tanggal Absensi')
                    ->required(),

                Forms\Components\TimePicker::make('check_in')
                    ->label('Jam Masuk')
                    ->required(),

                Forms\Components\TimePicker::make('check_out')
                    ->label('Jam Keluar')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status Kehadiran')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Sakit' => 'Sakit',
                        'Cuti' => 'Cuti',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // SpatieMediaLibraryImageColumn::make('foto_absensi')
                //     ->height('100px')
                //     ->width('100px')
                //     ->circular(),

                Tables\Columns\TextColumn::make('karyawan.nama')
                    ->label('Nama Karyawan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date(),

                Tables\Columns\TextColumn::make('check_in')
                    ->label('Jam Masuk'),

                Tables\Columns\TextColumn::make('check_out')
                    ->label('Jam Keluar'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Hadir' => 'success',
                        'Izin' => 'warning',
                        'Sakit' => 'danger',
                        'Cuti' => 'info',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Sakit' => 'Sakit',
                        'Cuti' => 'Cuti',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
        return 'Absensi Karyawan';
    }

    public static function getLabel(): ?string
    {
        return 'Absensi Karyawan';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbsensis::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}
