<?php

/**
 * Interface for recommendations configurations
 */

namespace Umutphp\LaravelModelRecommendation;

/**
 * Interface class
 */
trait HasRecommendation
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
