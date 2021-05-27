# Generate Recommendation List For Eloquent models

This package generates recommendation list for elequent models. It provides a simple API to work with to generate and list recommendations for a model.

Here are a few short examples of what you can do:

Generate recommendation list for the given model type.

```php
Product::generateRecommendations();
```

Get the list of recommended models for a model.

```php
$recommendations = $model->getRecommendations();
```

## How To Install

### Requiring The Library

```bash
composer require "umutphp/laravel-model-recommendation"
```

### Prepare The Database

```bash
php artisan vendor:publish --provider="Spatie\MediaLibraryPro\MediaLibraryProServiceProvider" --tag="media-library-pro-migrations"
php artisan migrate
```

### Add The Service Provider

Append the following line to the `providers` array;

```php
\Umutphp\LaravelModelRecommendation\ModelRecommendationServiceProvider::class,
```

### Add The Trait And Interface To The Model

Add `HasRecommendation` trait and `InteractWithRecommendation` interface to the class definition. Please do not forget to implement the functions of the interface.

Here are the functions to be implemented:

* `getRecommendationDataTable()`: Returns the name of the data table.
* `getRecommendationDataField()`: Returns the name of the data field.
* `getRecommendationGroupField()`: Returns the name of the group field.
* `getRecommendationCount()`: Returns the number of the items in the recommendation list.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Umutphp\LaravelModelRecommendation\InteractWithRecommendation;
use Umutphp\LaravelModelRecommendation\HasRecommendation;

class Product extends Model implements InteractWithRecommendation
{
    use HasFactory, HasRecommendation;

    public static function getRecommendationDataTable() :string
    {
        return 'order_products';
    }
    public static function getRecommendationDataField() :string
    {
        return 'product_id';
    }
    public static function getRecommendationGroupField() :string
    {
        return 'order_id';
    }
    public static function getRecommendationCount() :int
    {
        return 5;
    }
}


```

## How To Use

