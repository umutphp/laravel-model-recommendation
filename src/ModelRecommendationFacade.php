<?php

namespace Umutphp\LaravelModelRecommendation;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Umutphp\LaravelModelRecommendation\LaravelModelRecommendation
 */
class LaravelModelRecommendationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel_model_recommendation';
    }
}
