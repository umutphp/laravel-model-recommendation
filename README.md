# A generic package to create recommendation for eloquent models

[![Latest Version on Packagist](https://img.shields.io/packagist/v/umutphp/laravel_model_recommendation.svg?style=flat-square)](https://packagist.org/packages/umutphp/laravel_model_recommendation)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/umutphp/laravel_model_recommendation/run-tests?label=tests)](https://github.com/umutphp/laravel_model_recommendation/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/umutphp/laravel_model_recommendation/Check%20&%20fix%20styling?label=code%20style)](https://github.com/umutphp/laravel_model_recommendation/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/umutphp/laravel_model_recommendation.svg?style=flat-square)](https://packagist.org/packages/umutphp/laravel_model_recommendation)

[](delete) 1) manually replace `Umut Işık, umutphp, auhor@domain.com, umutphp, umutphp, Vendor Name, laravel-model-recommendation, laravel_model_recommendation, laravel_model_recommendation, LaravelModelRecommendation, A generic package to create recommendation for eloquent models` with their correct values
[](delete) in `CHANGELOG.md, LICENSE.md, README.md, ExampleTest.php, ModelFactory.php, LaravelModelRecommendation.php, LaravelModelRecommendationCommand.php, LaravelModelRecommendationFacade.php, LaravelModelRecommendationServiceProvider.php, TestCase.php, composer.json, create_laravel_model_recommendation_table.php.stub`
[](delete) and delete `configure-laravel_model_recommendation.sh`

[](delete) 2) You can also run `./configure-laravel_model_recommendation.sh` to do this automatically.

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/package-laravel_model_recommendation-laravel.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/package-laravel_model_recommendation-laravel)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require umutphp/laravel_model_recommendation
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Umutphp\LaravelModelRecommendation\LaravelModelRecommendationServiceProvider" --tag="laravel_model_recommendation-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Umutphp\LaravelModelRecommendation\LaravelModelRecommendationServiceProvider" --tag="laravel_model_recommendation-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravel_model_recommendation = new Umutphp\LaravelModelRecommendation();
echo $laravel_model_recommendation->echoPhrase('Hello, Spatie!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Umut Işık](https://github.com/umutphp)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
