<?php

namespace OwenVoke\GoogleFitTile\Commands;

use Illuminate\Console\Command;
use OwenVoke\GoogleFitTile\GoogleFitStore;
use OwenVoke\GoogleFitTile\Services\GoogleFit;

class FetchGoogleFitStepCountCommand extends Command
{
    /** {@inheritdoc} */
    protected $signature = 'dashboard:fetch-google-fit-step-count';

    /** {@inheritdoc} */
    protected $description = 'Fetch Google Fit step count';

    public function handle(): void
    {
        $this->info('Fetching Google Fit step count');

        $steps = GoogleFit::make()->getStepCount();

        GoogleFitStore::make()->setStepCount($steps);

        $this->info('All done!');
    }
}
