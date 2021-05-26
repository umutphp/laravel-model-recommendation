<?php

namespace Umutphp\LaravelModelRecommendation;

use Umutphp\LaravelModelRecommendation\RecommendationsModel;

trait InteractWithRecommendation
{
    /**
     * Generate recommendtaions and save it to the table
     *
     * @return void
     */
    public static function generateRecommendations()
    {

    }

    /**
     * Return the list of recommended models
     *
     * @return void
     */
    public function getRecommendations()
    {
        $recommendations = RecommendationsModel::all();
        
        return $recommendations;
    }
}
