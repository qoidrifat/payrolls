<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Penggajian; // Ganti dengan model Penggajian Anda
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SalaryChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Penggajian Bulan Ini';
    protected static ?int $sort = 2; // Mengatur urutan widget

    protected function getData(): array
    {
        $user = Auth::user();
        $userId = $user->id;

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $salaryData = Penggajian::whereHas('karyawan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->whereMonth('tanggal_penggajian', $currentMonth)
        ->whereYear('tanggal_penggajian', $currentYear)
        ->get();

        $labels = $salaryData->pluck('periode_penggajian')->toArray();
        $chartData = $salaryData->pluck('gaji_bersih')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Gaji Bersih',
                    'data' => $chartData,
                    'backgroundColor' => ['rgba(75, 192, 192, 0.2)'],
                    'borderColor' => ['rgba(75, 192, 192, 1)'],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Contoh menggunakan grafik garis
    }
}
