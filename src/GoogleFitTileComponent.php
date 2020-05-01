<?php

namespace OwenVoke\GoogleFitTile;

use Carbon\CarbonInterval;
use Livewire\Component;

class GoogleFitTileComponent extends Component
{
    /** @var string */
    public $position;

    public function mount(string $position): void
    {
        $this->position = $position;
    }

    public function render()
    {
        $googleFitStore = GoogleFitStore::make();

        return view('dashboard-google-fit-tile::tile', [
            'sleep' => CarbonInterval::seconds($googleFitStore->sleep())->cascade(),
            'stepCount' => $googleFitStore->stepCount(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.google_fit.refresh_interval_in_seconds', 60),
        ]);
    }
}
