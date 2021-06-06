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
}
