<?php

namespace OwenVoke\GoogleFitTile\Services;

use Carbon\Carbon;
use Google_Client;
use Google_Service_Fitness;
use Google_Service_Fitness_AggregateBy;
use Google_Service_Fitness_AggregateRequest;
use Google_Service_Fitness_BucketByTime;
use Google_Service_Fitness_Session as Session;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class GoogleFit
{
    public const CREDENTIALS_PATH = 'app/google/fit-credentials.json';
    public const ACTIVITY_TYPE_SLEEP = 72;

    private Google_Client $googleClient;

    private Google_Service_Fitness $client;

    public function __construct()
    {
        $this->googleClient = app(Google_Client::class);

        $this->googleClient->setAccessToken(json_decode(
            file_get_contents(storage_path(self::CREDENTIALS_PATH)), true, 512, JSON_THROW_ON_ERROR
        )['access_token']);

        $this->client = new Google_Service_Fitness($this->googleClient);
    }

    public static function make(): self
    {
        return new static();
    }

    public function getSleepHoursCount(): int
    {
        $response = $this->client->users_sessions->listUsersSessions('me');

        return collect($response->getSession())->filter(static function (Session $session) {
                return $session->getActivityType() === self::ACTIVITY_TYPE_SLEEP;
            })->filter(static function (Session $session) {
                return Carbon::parse((int) ($session->getEndTimeMillis() / 1000))->isToday();
            })->map(static function (Session $session) {
                return ($session->getEndTimeMillis() - $session->getStartTimeMillis()) / 1000;
            })->first() ?? 0;
    }

    public function getStepCount(): int
    {
        $request = new Google_Service_Fitness_AggregateRequest();

        $request->setAggregateBy([
            new Google_Service_Fitness_AggregateBy([
                'dataTypeName' => 'com.google.step_count.delta',
                'dataSourceId' => 'derived:com.google.step_count.delta:com.google.android.gms:estimated_steps',
            ]),
        ]);

        $request->setBucketByTime(new Google_Service_Fitness_BucketByTime([
            'durationMillis' => 86400000,
        ]));

        $request->setStartTimeMillis(Carbon::today()->timestamp * 1000);
        $request->setEndTimeMillis(Carbon::today()->addDay()->timestamp * 1000);

        $response = $this->client->users_dataset->aggregate('me', $request);

        return $response->getBucket()[0]->getDataset()[0]->getPoint()[0]->getValue()[0]->getIntVal() ?? 0;
    }

    public function refreshAccessToken(): bool
    {
        $token = json_decode(
            file_get_contents(storage_path(self::CREDENTIALS_PATH)), true, 512, JSON_THROW_ON_ERROR
        )['refresh_token'];

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $token,
            'client_id' => config('dashboard.tiles.google_fit.id'),
            'client_secret' => config('dashboard.tiles.google_fit.secret'),
        ])->json();

        if (! isset($response['access_token'])) {
            throw new RuntimeException('Failed to refresh the Google Fit auth token');
        }

        return (bool) file_put_contents(
            storage_path(self::CREDENTIALS_PATH),
            json_encode(array_merge($response, ['refresh_token' => $token]), JSON_THROW_ON_ERROR, 512)
        );
    }
}
