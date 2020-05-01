<?php

namespace OwenVoke\GoogleFitTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use OwenVoke\GoogleFitTile\Commands\FetchGoogleFitSleepCommand;
use OwenVoke\GoogleFitTile\Commands\FetchGoogleFitStepCountCommand;
use OwenVoke\GoogleFitTile\Commands\RefreshGoogleFitTokenCommand;

class GoogleFitTileServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('google-fit-tile', GoogleFitTileComponent::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                RefreshGoogleFitTokenCommand::class,
                FetchGoogleFitStepCountCommand::class,
                FetchGoogleFitSleepCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/dashboard-google-fit-tile'),
        ], 'dashboard-google-fit-tile-views');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dashboard-google-fit-tile');
    }
}
