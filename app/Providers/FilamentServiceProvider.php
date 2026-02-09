<?php

namespace App\Providers;

use Filament\Pages;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // // Registrasi komponen
        // Filament::registerComponent(Pages::class);
    }
}

?>
