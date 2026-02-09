<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Blade;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ->renderHook('panels::global-search.before', function (): string {
            //     return Blade::render(<<<BLADE
            //         <div style="text-align: left; padding: 1rem;">
            //             <a href="{{ url('/') }}">
            //                 <img src="{{ asset('images/logop.jpg') }}" alt="{{ config('app.name') }}" style="height: 4rem; max-width: 200px;">
            //             </a>
            //         </div>
            //     BLADE);
            // })
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])

            // ->renderHook('panels::logobrand', function (): string {
            //     return Blade::render(<<<BLADE
            //         <a href="{{ url('/') }}" style="display: flex; align-items: center; text-align: left;">
            //             <img src="{{ asset('images/logop.jpg') }}" alt="{{ config('app.name') }}"
            //                 style="height: 4rem; max-width: 200px; margin-right: 1rem;">
            //             <span style="font-size: 1.5rem; font-weight: bold; color: #333;">
            //                 {{ config('app.name') }}
            //             </span>
            //         </a>
            //     BLADE);
            // })

            // ->renderHook('panels::login.form.before', function (): string {
            //     return Blade::render(<<<BLADE
            //         <a href="{{ url('/') }}" style="display: flex; align-items: center; text-align: left;">
            //             <img src="{{ asset('images/logop.jpg') }}" alt="{{ config('app.name') }}"
            //                 style="height: 4rem; max-width: 200px; margin-right: 1rem;">
            //             <span style="font-size: 1.5rem; font-weight: bold; color: #333;">
            //                 {{ config('app.name') }}
            //             </span>
            //         </a>
            //     BLADE);
            // })


            // ->brandLogo(Blade::render('components.logo'))

            ->brandLogo(asset('images/logopp.jpg'))
            ->brandLogoHeight('4rem')
            ->favicon('images/icon.jpg')

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ]);
    }
}
