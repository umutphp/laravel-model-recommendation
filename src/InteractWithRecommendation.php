<?php

namespace Umutphp\LaravelModelRecommendation;

interface InteractWithRecommendation
{
    /**
     * Returns the array of configuration for the model.
     * [
     *     'recommendation_data_table'        => 'recommendation_data_table',
     *     'recommendation_data_table_filter' => [
     *           'field' => 'value'
     *     ],
     *     'recommendation_data_field'        => 'recommendation_data_field',
     *     'recommendation_data_field_type'   => 'recommendation_data_field_type',
     *     'recommendation_group_field'       => 'recommendation_group_field',
     *     'recommendation_count'             => 5,
     *     'recommendation_order'             => 'desc'
     * ]
     *
     * @return array
     */
    public static function getRecommendationConfig(): array;
}
