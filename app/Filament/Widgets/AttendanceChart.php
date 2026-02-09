<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Chartisan\PHP\Chartisan;
use App\Models\Absensi; // Ganti dengan model Daftar Hadir Anda
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Kehadiran Bulan Ini';
    protected static ?int $sort = 1; // Mengatur urutan widget

    protected function getData(): array
    {
        $user = Auth::user();
        $userId = $user->id; // Ambil ID user yang login

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $attendanceData = Absensi::where('user_id', $userId)
            ->whereMonth('tanggal', $currentMonth)
            ->whereYear('tanggal', $currentYear)
            ->selectRaw('date(tanggal) as tanggal, COUNT(*) as jumlah')
            ->groupBy('tanggal')
            ->get()
            ->pluck('jumlah', 'tanggal')
            ->toArray();


        $daysInMonth = Carbon::now()->daysInMonth;
        $chartData = [];
        $labels = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($currentYear, $currentMonth, $day)->format('Y-m-d');
            $labels[] = $day;
            $chartData[] = $attendanceData[$date] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kehadiran',
                    'data' => $chartData,
                    'backgroundColor' => ['rgba(54, 162, 235, 0.2)'],
                    'borderColor' => ['rgba(54, 162, 235, 1)'],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,

        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa juga 'line', 'pie', dll.
    }
}
