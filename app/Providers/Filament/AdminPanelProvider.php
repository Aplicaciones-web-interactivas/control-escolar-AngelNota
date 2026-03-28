<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::BODY_START,
                fn (): string => request()->routeIs('filament.admin.auth.login') 
                    ? '<style>body{background-color:#0f172a !important;} .fi-auth-page{background-color:transparent!important;} main.fi-simple-main{background-color:transparent!important;} .fi-simple-main section{background-color:rgba(30,41,59,0.7)!important; backdrop-filter:blur(16px)!important; border:1px solid rgba(255,255,255,0.1)!important; border-radius:1.5rem!important; box-shadow:0 0 40px rgba(59,130,246,0.15)!important;} .fi-logo{color:white!important;} h2.fi-simple-header-heading, p.fi-simple-header-subheading, .fi-simple-main label span, .fi-simple-main a {color:white!important;} @keyframes pulse-slow{0%,100%{opacity:0.3;transform:scale(1);}50%{opacity:0.5;transform:scale(1.05);}}</style><div class="absolute inset-0 z-[-1] pointer-events-none overflow-hidden"><div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] rounded-full bg-blue-600/30 blur-[120px] mix-blend-screen" style="animation: pulse-slow 8s infinite alternate;"></div><div class="absolute -bottom-[10%] -right-[10%] w-[50%] h-[50%] rounded-full bg-indigo-600/30 blur-[120px] mix-blend-screen" style="animation: pulse-slow 8s infinite alternate; animation-delay: 2s;"></div><div class="absolute top-[20%] left-[30%] w-[40%] h-[40%] rounded-full bg-cyan-600/20 blur-[100px] mix-blend-screen" style="animation: pulse-slow 8s infinite alternate; animation-delay: 4s;"></div></div>'
                    : ''
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
