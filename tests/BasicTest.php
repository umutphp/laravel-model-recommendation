<?php

namespace Umutphp\LaravelModelRecommendation\Tests;

use PHPUnit\Framework\TestCase;
use Umutphp\LaravelModelRecommendation\HasRecommendation;

class BasicTest extends TestCase
{
    use HasRecommendation;

    /** @test */
    public function testCalculateRecommendationsEmptyData()
    {
        $input = [];

        $output = self::calculateRecommendations($input, 5);

        $this->assertTrue($output === $input);
    }

    /** @test */
    public function testCalculateRecommendationsSimpleData()
    {
        $input = [
            (object) ['group_field' => 1, 'data_field' => 2],
            (object) ['group_field' => 1, 'data_field' => 3],
            (object) ['group_field' => 1, 'data_field' => 4],
            (object) ['group_field' => 2, 'data_field' => 4],
            (object) ['group_field' => 2, 'data_field' => 5]
        ];

        $output = self::calculateRecommendations($input, 5);

        $this->assertTrue($output[2][3] == 1);
        $this->assertTrue($output[2][4] == 1);
        $this->assertTrue($output[3][2] == 1);
        $this->assertTrue($output[3][4] == 1);
        $this->assertTrue($output[4][2] == 1);
        $this->assertTrue($output[4][3] == 1);
        $this->assertTrue($output[5][4] == 1);
    }
}
