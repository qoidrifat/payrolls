<?php

namespace App\Filament\Widgets;

use App\Models\Karyawan;
use App\Models\Penggajian;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;

class BlogAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Penggajian Karyawan';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];

    }

    // protected function getData(): array
    // {
    //     $data = Trend::model(Penggajian::class)
    //     ->between(
    //         start: Carbon::create(2024, 1, 1, 0, 0, 0), // Awal Januari 2024
    //         end: Carbon::create(2024, 12, 31, 23, 59, 59), // Akhir Desember 2024
    //     )
    //     ->perMonth()
    //     ->count();

    // return [
    //     'datasets' => [
    //         [
    //             'label' => 'Pengggajian',
    //             'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
    //         ],
    //     ],
    //     'labels' => $data->map(fn (TrendValue $value) => $value->date),
    // ];
    // }



    protected function getType(): string
    {
        return 'line';
    }
}

class KaryawanChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Karyawan per Bulan Bergabung';

    protected function getData(): array
    {
        $data = Trend::model(Karyawan::class)
            ->between(
                start: Carbon::create(2024, 1, 1, 0, 0, 0),
                end: Carbon::create(2024, 12, 31, 23, 59, 59),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Karyawan Baru',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB', // Example color
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date->format('F')), // Format month name
        ];
    }
    protected function getType(): string
    {
        return 'bar';
    }
}
