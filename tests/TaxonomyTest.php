<?php

namespace Umutphp\LaravelModelRecommendation\Tests;

use PHPUnit\Framework\TestCase;
use Umutphp\LaravelModelRecommendation\HasRecommendation;

class TaxonomyTest extends TestCase
{
    use HasRecommendation;

    /** @test */
    public function testGenerateTaxonomiesWithSimpleFields()
    {
        $model = (object) [
            'tag'      => 'new',
            'category' => 'shoe'
        ];

        $taxonomyFields = [['tag' => ''], ['category' => '']];

        $output = self::generateTaxonomies($model, $taxonomyFields);

        $this->assertTrue($output[0] == 'new');
        $this->assertTrue($output[1] == 'shoe');
    }

    /** @test */
    public function testGenerateTaxonomiesWithObjectFields()
    {
        $model = (object) [
            'tag'      => (object) ['title' => 'new'],
            'category' => (object) ['name' => 'shoe']
        ];

        $taxonomyFields = [['tag' => 'title'], ['category' => 'name']];

        $output = self::generateTaxonomies($model, $taxonomyFields);

        $this->assertTrue($output[0] == 'new');
        $this->assertTrue($output[1] == 'shoe');
    }

    /** @test */
    public function testGenerateTaxonomiesWithCollectionFields()
    {
        $tags       = collect([(object) ['title' => 'new'], (object) ['title' => 'popular']]);
        $categories = collect([(object) ['name' => 'shoe'], (object) ['name' => 'sport']]);
        $model      = (object) [
            'tags'       => $tags,
            'categories' => $categories
        ];

        $taxonomyFields = [['tags' => 'title'], ['categories' => 'name']];

        $output = self::generateTaxonomies($model, $taxonomyFields);

        $this->assertTrue($output[0] == 'new');
        $this->assertTrue($output[1] == 'popular');
        $this->assertTrue($output[2] == 'shoe');
        $this->assertTrue($output[3] == 'sport');
    }
}
