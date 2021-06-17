<?php

namespace Umutphp\LaravelModelRecommendation\Tests;

use PHPUnit\Framework\TestCase;
use Umutphp\LaravelModelRecommendation\HasRecommendation;

class SimilarityScoreTest extends TestCase
{
    use HasRecommendation;

    /** @test */
    public function testScoreWithSameModels()
    {
        $config                                        = [];
        $config['similarity_feature_attributes']       = ['type', 'material'];
        $config['similarity_taxonomy_attributes']      = [['tag' => ''], ['category' => '']];
        $config['similarity_numeric_value_attributes'] = ['price'];

        $model1 = new class {        
            public function toArray() { 
                return get_object_vars($this);
            }
        };

        $model1->name     = 'Product 1';
        $model1->type     = 'outdoor';
        $model1->material = 'cotton';
        $model1->tag      = 'new';
        $model1->category = 'shoe';
        $model1->price    = 123;

        $output = self::calculateSimilarityScore($model1, $model1, $config);

        $this->assertTrue($output == 100);
    }

    /** @test */
    public function testScoreWithModelsWithDifferentTag()
    {
        $config                                        = [];
        $config['similarity_feature_attributes']       = ['type', 'material'];
        $config['similarity_taxonomy_attributes']      = [['tag' => ''], ['category' => '']];
        $config['similarity_numeric_value_attributes'] = ['price'];

        $model1 = new class {        
            public function toArray() { 
                return get_object_vars($this);
            }
        };

        $model1->name     = 'Product 1';
        $model1->type     = 'outdoor';
        $model1->material = 'cotton';
        $model1->tag      = 'new';
        $model1->category = 'shoe';
        $model1->price    = 123;

        $model2 = new class {        
            public function toArray() { 
                return get_object_vars($this);
            }
        };

        $model2->name     = 'Product 1';
        $model2->type     = 'outdoor';
        $model2->material = 'cotton';
        $model2->tag      = 'old';
        $model2->category = 'shoe';
        $model2->price    = 123;

        $output = self::calculateSimilarityScore($model1, $model2, $config);

        $this->assertTrue($output !== 1);
    }

    /** @test */
    public function testScoreWithModelsWithDifferentWeights()
    {
        $config                                        = [];
        $config['similarity_feature_attributes']       = ['type', 'material'];
        $config['similarity_taxonomy_attributes']      = [['tag' => '', 'category' => '']];
        $config['similarity_numeric_value_attributes'] = ['price'];

        $model1 = new class {        
            public function toArray() { 
                return get_object_vars($this);
            }
        };

        $model1->name     = 'Product 1';
        $model1->type     = 'outdoor';
        $model1->material = 'cotton';
        $model1->tag      = 'new';
        $model1->category = 'shoe';
        $model1->price    = 123;

        $model2 = new class {        
            public function toArray() { 
                return get_object_vars($this);
            }
        };

        $model2->name     = 'Product 1';
        $model2->type     = 'outdoor';
        $model2->material = 'cotton';
        $model2->tag      = 'old';
        $model2->category = 'shoe';
        $model2->price    = 123;

        $output1 = self::calculateSimilarityScore($model1, $model2, $config);
        
        // Increment the feature weight value, so the score should be higher
        $config['similarity_feature_weight'] = 5;

        $output2 = self::calculateSimilarityScore($model1, $model2, $config);

        $this->assertTrue($output1 < $output2);
    }
}
