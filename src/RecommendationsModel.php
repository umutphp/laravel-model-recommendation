<?php

namespace Umutphp\LaravelModelRecommendation;

use Illuminate\Database\Eloquent\Model;

class RecommendationsModel extends Model
{
    protected $table = 'laravel_model_recommendation_table';

    protected $fillable = [
        'source_type',
        'source_id',
        'target_type',
        'target_id',
        'order_column'
    ];
}
