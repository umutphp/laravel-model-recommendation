<?php

namespace Umutphp\LaravelModelRecommendation;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Umutphp\LaravelModelRecommendation\ModelRecommendation
 */
class ModelRecommendationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel_model_recommendation';
    }
}
