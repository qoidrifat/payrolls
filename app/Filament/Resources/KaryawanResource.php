<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaryawanResource\Pages;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\KaryawanResource\RelationManagers;
use App\Models\Karyawan;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\BulkAction;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
{
    return $form
        ->schema([

            Forms\Components\TextInput::make('nama')
                ->required(),

            Forms\Components\TextInput::make('email')
                ->required()
                ->email()
                ->unique(ignoreRecord: true),

            Forms\Components\DatePicker::make('tanggal_lahir')
                ->required(),

            Forms\Components\TextInput::make('alamat')
                ->required(),

            // Forms\Components\Select::make('department_id')
            //     ->relationship('department', 'nama')
            //     ->label('Department')
            //     ->required()
            //     ->searchable()
            //     ->preload()
            //     ->live(), // Tambahkan live untuk mengupdate position

            Forms\Components\TextInput::make('position')
                ->label('Posisi')
                ->required()
                // Gunakan closure untuk default value
                ->default(function (Forms\Get $get) {
                    $departmentId = $get('department_id');
                    return $departmentId
                        ? Department::whereKey($departmentId)->value('nama')
                        : null;
                })
                ->live(onBlur: true),

            Forms\Components\Select::make('status')
                ->options([
                    'Tetap' => 'Tetap',
                    'Kontrak' => 'Kontrak',
                    'Harian' => 'Harian',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('nik')
                //     ->label(strtoupper('NIK'))
                //     ->searchable()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('nomor_telepon')
                //     ->searchable()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('npwp')
                //     ->label(strtoupper('NPWP'))
                //     ->searchable()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('nomor_rekening_bank')
                //     ->label('Nomor Rekening Bank')
                //     ->searchable()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('department.nama')
                //     ->label('Department')
                //     ->searchable()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Ganti dengan BulkAction khusus
                    BulkAction::make('bulk_edit')
                        ->label('Update Massal')
                        ->icon('heroicon-o-pencil-square')
                        ->form([
                            Forms\Components\Select::make('department_id')
                                ->relationship('department', 'nama')
                                ->label('Update Department')
                                ->searchable()
                                ->preload(),

                            Forms\Components\Select::make('status')
                                ->options([
                                    'Tetap' => 'Tetap',
                                    'Kontrak' => 'Kontrak',
                                    'Harian' => 'Harian',
                                ])
                                ->label('Update Status Karyawan'),

                            Forms\Components\TextInput::make('position')
                                ->label('Update Posisi'),
                        ])
                        ->action(function ($records, $data) {
                            $updatedCount = 0;

                            foreach ($records as $record) {
                                $updateData = [];

                                // Hanya update field yang diisi
                                if (!empty($data['department_id'])) {
                                    $updateData['department_id'] = $data['department_id'];
                                }

                                if (!empty($data['status'])) {
                                    $updateData['status'] = $data['status'];
                                }

                                if (!empty($data['position'])) {
                                    $updateData['position'] = $data['position'];
                                }

                                // Update record
                                if (!empty($updateData)) {
                                    $record->update($updateData);
                                    $updatedCount++;
                                }
                            }

                            // Notifikasi sukses
                            Notification::make()
                                ->title('Karyawan Berhasil Diupdate')
                                ->body("{$updatedCount} karyawan telah diperbarui")
                                ->success()
                                ->send();
                        })
                        // Tambahkan konfirmasi
                        ->requiresConfirmation()
                        ->modalHeading('Update Karyawan Massal')
                        ->modalDescription('Apakah Anda yakin ingin mengupdate karyawan yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Update'),

                    // Tetap pertahankan DeleteBulkAction
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
        return 'Daftar Karyawan';
    }

    public static function getLabel(): ?string
    {
        return 'Daftar Karyawan';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
        ];
    }
}
