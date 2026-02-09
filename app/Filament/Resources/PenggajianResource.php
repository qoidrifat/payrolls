<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Penggajian;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use App\Filament\Resources\PenggajianResource\Pages;

class PenggajianResource extends Resource
{
    protected static ?string $model = Penggajian::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('karyawan_id')
                    ->relationship('karyawan', 'nama')
                    ->label('Nama Karyawan')
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_penggajian')
                    ->label('Tanggal Penggajian')
                    ->required(),

                Forms\Components\TextInput::make('gaji_pokok')
                    ->label('Gaji Pokok')
                    ->prefix('IDR')
                    ->numeric()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Get $get, Set $set) => static::calculateGajiBersih($get, $set)),

                Forms\Components\TextInput::make('tunjangan')
                    ->label('Tunjangan')
                    ->prefix('IDR')
                    ->numeric()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Get $get, Set $set) => static::calculateGajiBersih($get, $set)),

                Forms\Components\TextInput::make('upah_lembur')
                    ->label('Upah Lembur')
                    ->prefix('IDR')
                    ->numeric()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Get $get, Set $set) => static::calculateGajiBersih($get, $set)),

                Forms\Components\TextInput::make('bonus')
                    ->label('Bonus')
                    ->prefix('IDR')
                    ->numeric()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Get $get, Set $set) => static::calculateGajiBersih($get, $set)),

                Forms\Components\TextInput::make('potongan')
                    ->label('Potongan')
                    ->prefix('IDR')
                    ->numeric()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Get $get, Set $set) => static::calculateGajiBersih($get, $set)),

                Forms\Components\TextInput::make('gaji_bersih')
                    ->label('Gaji Bersih')
                    ->prefix('IDR')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false), // Prevent dehydration to avoid overwriting calculated value

                Forms\Components\TextInput::make('periode_penggajian')
                    ->label('Periode Penggajian')
                    ->placeholder('Contoh: Januari 2023')
                    ->required(),
            ])
            ->columns(2);
    }

    private static function calculateGajiBersih(Get $get, Set $set): void
    {
        $gaji_pokok = $get('gaji_pokok') ?? 0;
        $tunjangan = $get('tunjangan') ?? 0;
        $upah_lembur = $get('upah_lembur') ?? 0;
        $bonus = $get('bonus') ?? 0;
        $potongan = $get('potongan') ?? 0;

        $gaji_bersih = $gaji_pokok + $tunjangan + $upah_lembur + $bonus - $potongan;

        $set('gaji_bersih', $gaji_bersih);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('karyawan.nama')
                    ->label('Nama Karyawan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_penggajian')
                    ->label('Tanggal Penggajian')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gaji_pokok')
                    ->label('Gaji Pokok')
                    ->formatStateUsing(fn ($state) => 'IDR ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('tunjangan')
                    ->label('Tunjangan')
                    ->formatStateUsing(fn ($state) => 'IDR ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('upah_lembur')
                    ->label('Upah Lembur')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => 'IDR ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('bonus')
                    ->label('Bonus')
                    ->formatStateUsing(fn ($state) => 'IDR ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('potongan')
                    ->label('Potongan')
                    ->formatStateUsing(fn ($state) => 'IDR ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('gaji_bersih')
                    ->label('Gaji Bersih')
                    ->formatStateUsing(fn ($state) => 'IDR ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('periode_penggajian')
                    ->label('Periode Penggajian')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                // Filter bisa ditambahkan di sini
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Download PDF')
                    ->label('Download PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function (Penggajian $record) {
                        if (! $record->karyawan) {
                            Notification::make()
                                ->title('Error')
                                ->body('Data karyawan tidak ditemukan untuk penggajian ini.')
                                ->danger()
                                ->send();

                            return;
                        }

                        $pdf = Pdf::loadView('pdf.penggajian', ['penggajian' => $record]);

                        $namaKaryawan = $record->karyawan?->nama ?? 'Unknown';
                        $periodePenggajian = $record->periode_penggajian ?? 'Unknown';

                        $filename = 'Penggajian_' . $namaKaryawan . '_' . $periodePenggajian . '.pdf';
                        $filename = preg_replace('/\s+/', '_', $filename);

                        Storage::disk('public')->put($filename, $pdf->output());

                        return response()->download(storage_path('app/public/' . $filename));
                    })
                    ->requiresConfirmation()
                    ->color('success'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPluralLabel(): ?string
    {
        return 'Penggajian Karyawan';
    }

    public static function getLabel(): ?string
    {
        return 'Penggajian Karyawan';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenggajians::route('/'),
            'create' => Pages\CreatePenggajian::route('/create'),
            'edit' => Pages\EditPenggajian::route('/{record}/edit'),
        ];
    }
}
