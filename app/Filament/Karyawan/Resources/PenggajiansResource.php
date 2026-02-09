<?php

namespace App\Filament\Karyawan\Resources;

use App\Filament\Karyawan\Resources\PenggajiansResource\Pages;
use App\Models\Penggajian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\Rule;
use Filament\Forms\Get; // Import Get class

class PenggajiansResource extends Resource
{
    protected static ?string $model = Penggajian::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('karyawan_id')
                    ->default(auth()->user()?->karyawan?->id)
                    ->required(),

                Select::make('nama_karyawan')
                    ->label('Nama Karyawan')
                    ->options(function () {
                        $user = auth()->user();
                        if ($user && $user->karyawan) {
                            return [$user->karyawan->id => $user->karyawan->nama];
                        }
                        return [];
                    })
                    ->disabled()
                    ->rules([
                        Rule::requiredIf(fn() => auth()->user() && !auth()->user()->karyawan),
                    ])
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state === null && auth()->user() && !auth()->user()->karyawan) {
                            Notification::make()
                                ->title('Error')
                                ->body('User yang login belum memiliki data karyawan.')
                                ->danger()
                                ->send();
                        }
                    }),

                DatePicker::make('tanggal_penggajian')->required(),

                TextInput::make('gaji_pokok')
                    ->prefix('IDR')
                    ->numeric()
                    ->required()
                    ->rules(['numeric', 'max:999999999999999'])
                    ->live(onBlur: true)
                    ->dehydrateStateUsing(fn ($state) => number_format($state, 0, ',', '.')), // Format untuk tampilan SAJA

                TextInput::make('tunjangan')
                    ->prefix('IDR')
                    ->numeric()
                    ->required()
                    ->rules(['numeric', 'max:999999999999999'])
                    ->live(onBlur: true)
                    ->dehydrateStateUsing(fn ($state) => number_format($state, 0, ',', '.')), // Format untuk tampilan SAJA

                TextInput::make('upah_lembur')
                    ->prefix('IDR')
                    ->numeric()
                    ->required()
                    ->rules(['numeric', 'max:999999999999999'])
                    ->live(onBlur: true)
                    ->dehydrateStateUsing(fn ($state) => number_format($state, 0, ',', '.')), // Format untuk tampilan SAJA

                TextInput::make('bonus')
                    ->prefix('IDR')
                    ->numeric()
                    ->required()
                    ->rules(['numeric', 'max:999999999999999'])
                    ->live(onBlur: true)
                    ->dehydrateStateUsing(fn ($state) => number_format($state, 0, ',', '.')), // Format untuk tampilan SAJA

                TextInput::make('potongan')
                    ->prefix('IDR')
                    ->numeric()
                    ->required()
                    ->rules(['numeric', 'max:999999999999999'])
                    ->live(onBlur: true)
                    ->dehydrateStateUsing(fn ($state) => number_format($state, 0, ',', '.')), // Format untuk tampilan SAJA

                TextInput::make('gaji_bersih')
                    ->prefix('IDR')
                    ->numeric()
                    ->disabled()
                    ->dehydrateStateUsing(function (Get $get) {
                        $gaji_pokok = (float)str_replace('.', '', $get('gaji_pokok') ?? 0);
                        $tunjangan = (float)str_replace('.', '', $get('tunjangan') ?? 0);
                        $upah_lembur = (float)str_replace('.', '', $get('upah_lembur') ?? 0);
                        $bonus = (float)str_replace('.', '', $get('bonus') ?? 0);
                        $potongan = (float)str_replace('.', '', $get('potongan') ?? 0);

                        $total = max(0, $gaji_pokok + $tunjangan + $upah_lembur + $bonus - $potongan);
                        return number_format($total, 0, ',', '.');
                    }),

                TextInput::make('periode_penggajian')
                    ->placeholder('Contoh: Januari 2023')
                    ->required(),
            ])
            ->columns(2);
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
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('gaji_pokok')
                //     ->formatStateUsing(fn($state) => 'IDR ' . number_format((float)$state, 0, ',', '.')),
                // Tables\Columns\TextColumn::make('tunjangan')
                //     ->formatStateUsing(fn($state) => 'IDR ' . number_format((float)$state, 0, ',', '.')),
                // Tables\Columns\TextColumn::make('upah_lembur')
                //     ->formatStateUsing(fn($state) => 'IDR ' . number_format((float)$state, 0, ',', '.')),
                // Tables\Columns\TextColumn::make('bonus')
                //     ->formatStateUsing(fn($state) => 'IDR ' . number_format((float)$state, 0, ',', '.')),
                // Tables\Columns\TextColumn::make('potongan')
                //     ->formatStateUsing(fn($state) => 'IDR ' . number_format((float)$state, 0, ',', '.')),
                // Tables\Columns\TextColumn::make('gaji_bersih')
                //     ->formatStateUsing(fn($state) => 'IDR ' . number_format((float)$state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('periode_penggajian')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Data Penggajian Tidak Ditemukan')
            ->emptyStateDescription('Tidak ada data penggajian untuk ditampilkan.');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPluralLabel(): ?string
    {
        return 'Penggajian';
    }

    public static function getLabel(): ?string
    {
        return 'Penggajian';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenggajians::route('/'),
            'create' => Pages\CreatePenggajians::route('/create'),
            'edit' => Pages\EditPenggajians::route('/{record}/edit'),
        ];
    }
}
