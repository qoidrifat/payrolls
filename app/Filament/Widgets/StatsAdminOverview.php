<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Department;
use App\Models\Karyawan;
use App\Models\User;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $activeUsers = User::count();
        return [
            Stat::make('Karyawan Terdaftar', User::query()->count())
                ->description('Akun Karyawan yang sudah terdaftar di database')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Departemen', Department::query()->count())
                ->description('Total departemen yang terdaftar')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Total Karyawan', Karyawan::query()->count())
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
?>