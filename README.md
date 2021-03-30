# Version Comparison

A Laravel package that compares the current git commit SHA with a remotely tracked version to see if the application is outdated, this is used in some of my projects to allow users to see when their instance of my software is out of date.

> **Note:** The project relies on private version tracking software, it will not do anything without a tracking ID the system can use to compare commit SHAs.

## Installation

You can install the package via composer:

```bash
composer require senither/version-comparison
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Senither\VersionComparison\VersionComparisonServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [

    /**
     * The unique ID for the project that the latest git commit SHA
     * should be compared with via the API, this can be found on
     * the version tracker when selecting the project.
     *
     * @url https://vt.senither.com/dashboard
     */
    'id' => env('VERSION_COMPARISON_ID', null),
];

```

## Usage

```php
use Senither\VersionComparison\Facades\Version;

// Gets the current version
Version::getCurrentVersion();
```

## License

The Version Comparison package open-sourced software licensed under the [MIT license](LICENSE.md).
