<?php

namespace Umutphp\LaravelModelRecommendation;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Umutphp\LaravelModelRecommendation\Commands\LaravelModelRecommendationCommand;

class LaravelModelRecommendationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel_model_recommendation')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_model_recommendation_table')
            ->hasCommand(LaravelModelRecommendationCommand::class);
    }
}
