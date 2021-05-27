<?php

namespace Umutphp\LaravelModelRecommendation;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ModelRecommendationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel_model_recommendation')
            ->hasConfigFile('laravel_model_recommendation')
            ->hasMigration('create_model_recommendation_table');
    }
}
