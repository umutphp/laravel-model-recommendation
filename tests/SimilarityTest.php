<?php

namespace Umutphp\LaravelModelRecommendation\Tests;

use PHPUnit\Framework\TestCase;
use Umutphp\LaravelModelRecommendation\HasRecommendation;
use Umutphp\LaravelModelRecommendation\SimilarityHelper;

class SimilarityTest extends TestCase
{
    use HasRecommendation;

    /** @test */
    public function testHammingWithEmptyStrings()
    {
        $input1 = '';
        $input2 = '';

        $output = SimilarityHelper::hamming($input1, $input2, true);
        
        $this->assertTrue($output == 0);
    }

    /** @test */
    public function testHammingWithShortStrings1()
    {
        $input1 = 'abcde';
        $input2 = 'abcdefgh';

        $output = SimilarityHelper::hamming($input1, $input2, true);
        
        $this->assertTrue($output == 0);
    }

    /** @test */
    public function testHammingWithShortStrings2()
    {
        $input1 = 'asdfgh';
        $input2 = 'abcdefgh';

        $output = SimilarityHelper::hamming($input1, $input2, true);
        
        $this->assertTrue($output == 5);
    }

    /** @test */
    public function testEuclideanWithEmptyArrays()
    {
        $input1 = [];
        $input2 = [];

        $output = SimilarityHelper::euclidean($input1, $input2, true);
        
        $this->assertTrue($output == 0);
    }

    /** @test */
    public function testEuclideanWithSameArrays()
    {
        $input1 = [100];
        $input2 = [100];

        $output = SimilarityHelper::euclidean($input1, $input2, true);
        
        $this->assertTrue($output == 0);

        $input1 = [100, 101, 102, 103];
        $input2 = [100, 101, 102, 103];

        $output = SimilarityHelper::euclidean($input1, $input2, true);
        
        $this->assertTrue($output == 0);
    }

    /** @test */
    public function testEuclideanWithDifferentArrays()
    {
        $input1 = [101];
        $input2 = [111];

        $output = SimilarityHelper::euclidean($input1, $input2, true);
        
        $this->assertTrue($output == 10);

        $input1 = [101, 202];
        $input2 = [100, 200];

        $output = SimilarityHelper::euclidean($input1, $input2, true);

        $this->assertTrue((string) $output === (string) 2.2360679774998);
    }

    /** @test */
    public function testJaccardWithEmptyStrings()
    {
        $input1 = '';
        $input2 = '';

        $output = SimilarityHelper::jaccard($input1, $input2, ',');

        $this->assertTrue($output == 1);
    }

    /** @test */
    public function testJaccardWithSameStrings()
    {
        $input1 = 'tag1,tag2';
        $input2 = 'tag1,tag2';

        $output = SimilarityHelper::jaccard($input1, $input2, ',');

        $this->assertTrue($output == 1);
    }

    /** @test */
    public function testJaccardWithDifferentStrings1()
    {
        $input1 = 'tag1,tag2';
        $input2 = 'tag3,tag4';

        $output = SimilarityHelper::jaccard($input1, $input2, ',');

        $this->assertTrue($output == 0);
    }

    /** @test */
    public function testJaccardWithDifferentStrings2()
    {
        $input1 = 'tag1,tag2,tag3';
        $input2 = 'tag3,tag4,tag5';

        $output = SimilarityHelper::jaccard($input1, $input2, ',');

        $this->assertTrue((string) $output === (string) 0.2);
    }
}
