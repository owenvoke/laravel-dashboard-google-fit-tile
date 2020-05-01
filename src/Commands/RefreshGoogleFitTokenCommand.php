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

    public function handle(): ?int
    {
        $this->info('Refreshing Google Fit auth token');

        try {
            GoogleFit::make()->refreshAccessToken();
        } catch (\RuntimeException $exception) {
            $this->warn($exception->getMessage());

            return 1;
        }

        $this->info('All done!');

        return 0;
    }
}
