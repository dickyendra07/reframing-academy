<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
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
            ->brandName('Reframing Academy')
            ->brandLogo('https://reframingphysio.com/wp-content/uploads/2026/02/cropped-FAVICON.png')
            ->brandLogoHeight('2.4rem')
            ->colors([
                'primary' => Color::Sky,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\AdminStatsOverview::class,
                \App\Filament\Widgets\LatestRegistrations::class,
                \App\Filament\Widgets\PendingPayments::class,
                \App\Filament\Widgets\PendingDocuments::class,
                \Filament\Widgets\AccountWidget::class,
            ])
            ->renderHook(
                'panels::head.end',
                fn (): HtmlString => new HtmlString(<<<'HTML'
<style>
    :root {
        --ra-navy: #123a56;
        --ra-blue: #1d6f99;
        --ra-soft: #f8fbfd;
        --ra-line: #e6edf3;
    }

    .fi-simple-layout {
        background:
            radial-gradient(circle at top left, rgba(29, 111, 153, 0.14), transparent 30%),
            radial-gradient(circle at bottom right, rgba(18, 58, 86, 0.12), transparent 28%),
            linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%) !important;
    }

    .fi-simple-main {
        position: relative;
        border-radius: 34px !important;
        border: 1px solid var(--ra-line) !important;
        background: rgba(255, 255, 255, 0.92) !important;
        box-shadow: 0 28px 80px rgba(18, 58, 86, 0.10) !important;
        overflow: hidden;
    }

    .fi-simple-main::before {
        content: "Admin Portal";
        display: block;
        margin-bottom: 18px;
        color: var(--ra-blue);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .fi-logo {
        color: var(--ra-navy) !important;
        font-weight: 950 !important;
        letter-spacing: -0.4px !important;
    }

    .fi-simple-header img,
    .fi-logo img {
        border-radius: 999px !important;
        box-shadow: 0 12px 28px rgba(18, 58, 86, 0.14);
    }

    .fi-simple-header-heading {
        color: var(--ra-navy) !important;
        font-weight: 950 !important;
        letter-spacing: -1px !important;
    }

    .fi-input-wrp {
        border-radius: 18px !important;
        background: var(--ra-soft) !important;
        border-color: var(--ra-line) !important;
        box-shadow: none !important;
    }

    .fi-input-wrp:focus-within {
        border-color: #9ed7ec !important;
        box-shadow: 0 0 0 4px rgba(29, 111, 153, 0.10) !important;
        background: white !important;
    }

    .fi-btn {
        border-radius: 999px !important;
        font-weight: 900 !important;
    }

    .fi-btn-color-primary {
        background: var(--ra-navy) !important;
        box-shadow: 0 16px 34px rgba(18, 58, 86, 0.16) !important;
    }

    .fi-btn-color-primary:hover {
        background: var(--ra-blue) !important;
    }

    .fi-link {
        color: var(--ra-blue) !important;
        font-weight: 800 !important;
    }

    .fi-sidebar-header,
    .fi-topbar {
        border-color: var(--ra-line) !important;
    }
</style>
HTML)
            )
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
            ]);
    }
}