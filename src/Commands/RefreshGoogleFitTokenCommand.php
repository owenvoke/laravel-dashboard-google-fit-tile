<?php

namespace OwenVoke\GoogleFitTile\Commands;

use Illuminate\Console\Command;
use OwenVoke\GoogleFitTile\Services\GoogleFit;

class RefreshGoogleFitTokenCommand extends Command
{
    /** {@inheritdoc} */
    protected $signature = 'dashboard:refresh-google-fit-token';

    /** {@inheritdoc} */
    protected $description = 'Refresh the auth token for Google Fit';

    public function handle(): void
    {
        $this->info('Refreshing Google Fit auth token');

        GoogleFit::make()->refreshAccessToken();

        $this->info('All done!');
    }
}
