<?php

namespace App\Filament\Karyawan\Pages;

use Filament\Pages\Page;

class About extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static string $routePath = '/about';
    protected static ?string $navigationLabel = 'Tentang Kami';
    protected static ?string $title = 'Tentang Sistem Penggajian'; // Opsional, bisa juga di view

    protected static string $view = 'filament.pages.about';
}
