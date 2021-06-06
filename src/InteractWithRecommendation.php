<?php

namespace Umutphp\LaravelModelRecommendation;

interface InteractWithRecommendation
{
    /**
     * Returns the array of configuration for the model.
     * [
     *     'recommendation_name_1' => [
     *         'recommendation_algorithm'         => 'db_relation', // db_relation, similiarty
     *         'recommendation_data_table'        => 'recommendation_data_table',
     *         'recommendation_data_table_filter' => [
     *             'field' => 'value'
     *         ],
     *         'recommendation_data_field'        => 'recommendation_data_field',
     *         'recommendation_data_field_type'   => 'recommendation_data_field_type',
     *         'recommendation_group_field'       => 'recommendation_group_field',
     *         'recommendation_count'             => 5,
     *         'recommendation_order'             => 'desc'
     *     ],
     *     'recommendation_name_2' => [
     *         'recommendation_algorithm'            => 'similiarty', // db_relation, similiarty
     *         'similarity_feature_weight'           => 1,
     *         'similarity_numeric_value_weight'     => 1,
     *         'similarity_numeric_value_high_range' => 1,
     *         'similarity_taxonomy_weight'          => 1,
     *         'similarity_feature_attributes'       => [
     *             'attribute1', 'attribute2'
     *         ],
     *         'similarity_numeric_value_attributes' => [
     *             'attribute1', 'attribute2'
     *         ],
     *         'similarity_taxonomy_attributes'      => [
     *             [
     *                  'relation' => 'attribute'
     *             ]
     *         ],
     *         'recommendation_count'                => 5,
     *         'recommendation_order'                => 'desc'
     *     ]
     * ]
     *
     * @return array
     */
    public static function getRecommendationConfig(): array;
}
