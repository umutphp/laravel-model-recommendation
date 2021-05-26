<?php

namespace Umutphp\LaravelModelRecommendation;

use Umutphp\LaravelModelRecommendation\RecommendationsModel;

interface InteractWithRecommendation
{
    public function getDataTable(): string;
}
