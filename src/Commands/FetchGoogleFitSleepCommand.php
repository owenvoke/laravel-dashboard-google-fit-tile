<?php

namespace OwenVoke\GoogleFitTile\Commands;

use Illuminate\Console\Command;
use OwenVoke\GoogleFitTile\GoogleFitStore;
use OwenVoke\GoogleFitTile\Services\GoogleFit;

class FetchGoogleFitSleepCommand extends Command
{
    /** {@inheritdoc} */
    protected $signature = 'dashboard:fetch-google-fit-sleep';

    /** {@inheritdoc} */
    protected $description = 'Fetch Google Fit sleep data';

    public function handle(): void
    {
        $this->info('Fetching Google Fit sleep data');

        $statistics = GoogleFit::make()->getSleepHoursCount();

        GoogleFitStore::make()->setSleep($statistics);

        $this->info('All done!');
    }
}
