<?php

namespace App\Providers;

use Filament\Notifications\Livewire\Notifications;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Enums\Alignment;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        URL::forceHttps(env('APP_HTTPS'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Notifications::alignment(Alignment::Center);
        FilamentAsset::register([
            Css::make('scrollbar', __DIR__ . '/../../resources/css/scrollbar.css'),
            Js::make('custom-print', __DIR__ . '/../../resources/js/custom-print.js'),
        ]);
    }
}
