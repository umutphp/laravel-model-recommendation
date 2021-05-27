<?php

namespace Umutphp\LaravelModelRecommendation;

interface InteractWithRecommendation
{
    public static function getRecommendationDataTable(): string;
    public static function getRecommendationDataField(): string;
    public static function getRecommendationGroupField(): string;
    public static function getRecommendationCount(): int;
}
