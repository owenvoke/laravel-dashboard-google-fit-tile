# Google Fit Tile

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-github-actions]][link-github-actions]
[![Style CI][ico-styleci]][link-styleci]
[![Total Downloads][ico-downloads]][link-downloads]
[![Buy us a tree][ico-treeware-gifting]][link-treeware-gifting]

A tile for Laravel Dashboard that displays statistics from Google Fit

## Install

Via Composer

```bash
$ composer require owenvoke/laravel-dashboard-google-fit-tile
```

## Usage

In the `dashboard` config file, you must add this configuration in the `tiles` key.

```php
// in config/dashboard.php

return [
    // ...
    'tiles' => [
        'google_fit' => [
            'id' => env('GOOGLE_FIT_ID'),
            'secret' => env('GOOGLE_FIT_SECRET'),
        ],
    ],
];
```

In `app\Console\Kernel.php` you should schedule the `OwenVoke\GoogleFitTile\Commands\RefreshGoogleFitTokenCommand` to run every `30` minutes.

If you want step count data, set the `OwenVoke\GoogleFitTile\Commands\FetchGoogleFitStepCountCommand` to run every `x` minutes as well.

If you want sleep data, set the `OwenVoke\GoogleFitTile\Commands\FetchGoogleFitSleepCommand` to run every `x` minutes as well.

```php
// in app/console/Kernel.php

protected function schedule(Schedule $schedule)
{
    $schedule->command(\OwenVoke\GoogleFitTile\Commands\RefreshGoogleFitTokenCommand::class)->everyThirtyMinutes();

    // Data fetching commands
    $schedule->command(\OwenVoke\GoogleFitTile\Commands\FetchGoogleFitStepCountCommand::class)->everyTenMinutes();
    $schedule->command(\OwenVoke\GoogleFitTile\Commands\FetchGoogleFitSleepCommand::class)->everyTenMinutes();
}
```

In your dashboard view you use the `livewire:google-fit-tile` component.

```blade
<x-dashboard>
    <livewire:google-fit-tile position="a1" />
</x-dashboard>
```

**Generate Google Fit credentials**

1. Create a Google project and generate [API Credentials](https://console.developers.google.com/apis/credentials)
1. Click the "Authorize APIs" button on Google's [OAuth Playground](https://developers.google.com/oauthplayground/#step1&apisSelect=https://www.googleapis.com/auth/fitness.activity.read)
1. Click the "Exchange authorization code for tokens" button
1. Copy the JSON (with `access_token`/`refresh_token`) from the bottom right panel
1. Add this to a JSON file in `storage/app/google/fit-credentials.json`
1. Run the `artisan dashboard:refresh-google-fit-token` command manually to validate the configuration

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@voke.dev instead of using the issue tracker.

## Credits

- [Owen Voke][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment you are required to buy the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to plant trees. If you support this package and contribute to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees [here][link-treeware-gifting].

Read more about Treeware at [treeware.earth][link-treeware].

[ico-version]: https://img.shields.io/packagist/v/owenvoke/laravel-dashboard-google-fit-tile.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-github-actions]: https://img.shields.io/github/workflow/status/owenvoke/laravel-dashboard-google-fit-tile/Continuous%20Integration.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/260413461/shield
[ico-downloads]: https://img.shields.io/packagist/dt/owenvoke/laravel-dashboard-google-fit-tile.svg?style=flat-square
[ico-treeware-gifting]: https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-lightgreen?style=flat-square

[link-packagist]: https://packagist.org/packages/owenvoke/laravel-dashboard-google-fit-tile
[link-github-actions]: https://github.com/owenvoke/laravel-dashboard-google-fit-tile/actions
[link-styleci]: https://styleci.io/repos/260413461
[link-downloads]: https://packagist.org/packages/owenvoke/laravel-dashboard-google-fit-tile
[link-treeware]: https://treeware.earth
[link-treeware-gifting]: https://offset.earth/owenvoke?gift-trees
[link-author]: https://github.com/owenvoke
[link-contributors]: ../../contributors
