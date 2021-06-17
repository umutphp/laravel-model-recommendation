# Generate Recommendation List For Eloquent models

![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/umutphp/laravel-model-recommendation) [![WOSPM Checker](https://github.com/umutphp/laravel-model-recommendation/actions/workflows/wospm.yml/badge.svg)](https://github.com/umutphp/laravel-model-recommendation/actions/workflows/wospm.yml) [![Codestyle Check](https://github.com/umutphp/laravel-model-recommendation/actions/workflows/phpcs.yml/badge.svg)](https://github.com/umutphp/laravel-model-recommendation/actions/workflows/phpcs.yml) [![Tests](https://github.com/umutphp/laravel-model-recommendation/actions/workflows/tests.yml/badge.svg)](https://github.com/umutphp/laravel-model-recommendation/actions/workflows/tests.yml) [![Markdown Linter](https://github.com/umutphp/laravel-model-recommendation/actions/workflows/mardown-lint.yml/badge.svg)](https://github.com/umutphp/laravel-model-recommendation/actions/workflows/mardown-lint.yml)

This package generates recommendation list for elequent models objects. It provides a simple API to work with to generate and list recommendations for a model.

![Laravel Model Recommendation](./assets/images/logo.png)

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->

- [Glosary](#glosary)
- [How To Install](#how-to-install)
  - [Requiring The Library](#requiring-the-library)
  - [Prepare The Database](#prepare-the-database)
  - [Add The Service Provider](#add-the-service-provider)
  - [Add The Trait And Interface To The Model](#add-the-trait-and-interface-to-the-model)
- [How To Use](#how-to-use)
  - [Algorithms](#algorithms)
    - [DB Relation](#db-relation)
    - [Similarity](#similarity)
  - [Use Case 1](#use-case-1)
  - [Use Case 2](#use-case-2)
  - [Use Case 3](#use-case-3)
  - [Use Case 4](#use-case-4)
  - [Use Case 5](#use-case-5)
  - [Use Case 6](#use-case-6)
- [Contributing](#contributing)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Credits](#credits)
- [License](#license)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Glosary

* **Data Table**: The table that stores the occurance (mosprobably with the ID of the model) of the models. Please look at the use cases for the example tables.
* **Group Field**: The field of the table that defines the co-occurance of the models.
* **Data Field**: The field that identifies the models.

## How To Install

### Requiring The Library

```bash
composer require "umutphp/laravel-model-recommendation"
```

### Prepare The Database

```bash
php artisan vendor:publish --provider="Umutphp\LaravelModelRecommendation\ModelRecommendationServiceProvider"
php artisan migrate
```

### Add The Service Provider

Append the following line to the `providers` array in `config/app.php`;

```php
Umutphp\LaravelModelRecommendation\ModelRecommendationServiceProvider::class,
```

### Add The Trait And Interface To The Model

Add `HasRecommendation` trait and `InteractWithRecommendation` interface to the class definition of the model. Please do not forget to implement the config function of the interface.

`getRecommendationConfig()`: It should returns a multi dimensional array as follows with correct values. The definition of values in inner arrays are;

* **recommendation_algorithm**: The choice of method for generating recommendations. The choices are `db_relation` and `similarity` for now. Some of the other keys are mandatory according to the choice.
* **recommendation_data_table**: The name of the data table which is mandatory when `db_relation` algorithm is choosen.
* **recommendation_data_table_filter**: The array of the filter values to be used in the query for fetching data from data table which is optional and can be used when `db_relation` algorithm is choosen. The array will contain fields and values as key-value pairs.
* **recommendation_data_field**: The name of the data field which is mandatory when `db_relation` algorithm is choosen.
* **recommendation_data_field_type**: The model class of the data field which is optional and can be used when `db_relation` algorithm is choosen.
* **recommendation_group_field**: The name of the group field which is mandatory when `db_relation` algorithm is choosen.
* **recommendation_count**: The number of recommendations generated per model. It is optional and the default value from config file is used instead.
* **recommendation_order**: The order of the recommendation list. Possible values are `asc`, `desc`, `random`. It is optional and the default value from config file is used instead.
* **similarity_feature_attributes**: The list of model attributes to be used in feature similarity calculations. It is an array contantaing the model attribute names (`color`, `material` for a product model etc.).
* **similarity_numeric_value_attributes**: The list of attributes with numeric values (such as price for products or age for humans etc.) to be used in similarity calculations. It is an array contantaing the model attribute names.
* **similarity_numeric_value_high_range**: A higher range for the numeric values. Please try to choose a bigger number than the maxiumum value for the numeric value choosen.
* **similarity_taxonomy_attributes**: The list of model attributes defining the relation between taxonomy value and the model. It is an array that contains the relation name as key and the name of attribute in the relation model as the value (`category` => `name`). You should use empty string as the value if your taxonomy is in a simple field (`tag` => `''`). 
* **similarity_feature_weight**: The weight of the model features in similarity calculation. It is optional and  `1` as the default value is used instead to make all the calculations are in equal weight.
* **similarity_numeric_value_weight**: The weight of the numeric fields in similarity calculation. It is optional and  `1` as the default value is used instead to make all the calculations are in equal weight.
* **similarity_taxonomy_weight**: The weight of the taxonomoy values in similarity calculation. It is optional and  `1` as the default value is used instead to make all the calculations are in equal weight.

A sample model class definition is as follows;

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Umutphp\LaravelModelRecommendation\InteractWithRecommendation;
use Umutphp\LaravelModelRecommendation\HasRecommendation;

class ModelName extends Model implements InteractWithRecommendation
{
    use HasFactory, HasRecommendation;


    public static function getRecommendationConfig() :array
    {
        return [
            'recommendation_name' => [
                'recommendation_algorithm'         => 'db_relation',
                'recommendation_data_table'        => 'recommendation_data_table',
                'recommendation_data_table_filter' => [
                    'field' => 'value'
                ],
                'recommendation_data_field'        => 'recommendation_data_field',
                'recommendation_data_field_type'   => 'recommendation_data_field_type',
                'recommendation_group_field'       => 'recommendation_group_field',
                'recommendation_count'             => 5
                'recommendation_order'             => 'desc'
            ]
        ];
    }
}
```

## How To Use

Here are a few short examples of what you can do.

* To generate recommendation list for the given model type. This function can be called in an Artisan command and scheduled to run periodically.

```php
ModelName::generateRecommendations('recommendation_name');
```

* To get the list of recommended models for a model.

```php
$recommendations = $model->getRecommendations('recommendation_name');
```

For these functions (generateRecommendations() and getRecommendations()) to be executed correctly, you should implement the config function described in [Add The Trait And Interface To The Model](#add-the-trait-and-interface-to-the-model) section. The methods used to generate the recommendations and some use cases thay may help you are explained below.

### Recommendation Generation Methods

#### DB Relation

This is an item based filtering ([collaborative filtering](https://en.wikipedia.org/wiki/Collaborative_filtering)) method by using the co-occurrence of the models in a data table under same group defined with a field.

#### Similarity

Inspired from the great articale "[Building a Product Recommender System with Machine Learning in Laravel](https://oliverlundquist.com/2019/03/11/recommender-system-with-ml-in-laravel.html)" by [Oliver Lundquist](https://oliverlundquist.com/).

The recommendation list is generated from a similarity calculation between models by using the field and taxonomy values of the objects.

### Use Case 1

Assume that you want to get recommendations for products (sold together) in an e-commerce site. You have `Product` model and `order_products` table storing the relation between orders and products.

**order_products** table;

| Field1 | Field2 | Field3 | Field4 | Field5 | Field6 |
| --- | --- | --- | --- | --- | --- |
| id | order_id | product_id | product_count | created_at | updated_at |


**Product** model class;

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

    public static function getRecommendationConfig() :array
    {
        return [
            'sold_together' => [
                'recommendation_algorithm'         => 'db_relation',
                'recommendation_data_table'        => 'order_products',
                'recommendation_data_table_filter' => [],
                'recommendation_data_field'        => 'product_id',
                'recommendation_data_field_type'   => self::class,
                'recommendation_group_field'       => 'order_id',
                'recommendation_count'             => 5
            ]
        ];
    }
}
```

**Function** calls;

```php
<?php
...

use App\Model\Product;

Product::generateRecommendations('sold_together');

$product1        = Product::find(1);
$recommendations = $product1->getRecommendations('sold_together');

```

### Use Case 2

Assume that you want to get recommendations for users in a dating site. You have `User` model and `user_friends` table storing the relation between users.

**user_friends** table;

| Field1 | Field2 | Field3 | Field4 | Field5 |
| --- | --- | --- | --- | --- |
| id | user_id | friend_id | created_at | updated_at |

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Umutphp\LaravelModelRecommendation\InteractWithRecommendation;
use Umutphp\LaravelModelRecommendation\HasRecommendation;

class User extends Model implements InteractWithRecommendation
{
    use HasFactory, HasRecommendation;

    public static function getRecommendationConfig() :array
    {
        return [
            'possible_match' => [
                'recommendation_algorithm'         => 'db_relation',
                'recommendation_data_table'        => 'user_friends',
                'recommendation_data_table_filter' => [],
                'recommendation_data_field'        => 'friend_id',
                'recommendation_data_field_type'   => self::class,
                'recommendation_group_field'       => 'user_id',
                'recommendation_count'             => 5
            ]
        ];
    }
}
```

**Function** calls;

```php
<?php
...

use App\Model\User;

User::generateRecommendations('possible_match');

$user1           = User::find(1);
$recommendations = $user1->getRecommendations('possible_match');

```

### Use Case 3

A use case for generating recommendations from product similarity. We have `products` and `category` table as follows and a one-to-one relation between them.

**products** table;

| Field1 | Field2 | Field3 | Field4 | Field5 |
| --- | --- | --- | --- | --- |
| id | color | material | price | category_id |

**category** table;

| Field1 | Field2 |
| --- | --- |
| id | name |

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

    public static function getRecommendationConfig() :array
    {
        return [
            'similar_products' => [
                'recommendation_algorithm'            => 'similarity',
                'similarity_feature_weight'           => 1,
                'similarity_numeric_value_weight'     => 1,
                'similarity_numeric_value_high_range' => 1,
                'similarity_taxonomy_weight'          => 1,
                'similarity_feature_attributes'       => [
                    'material', 'color'
                ],
                'similarity_numeric_value_attributes' => [
                    'price'
                ],
                'similarity_taxonomy_attributes'      => [
                    [
                        'category' => 'name'
                    ]
                ],
                'recommendation_count'                => 2,
                'recommendation_order'                => 'desc'
            ]
        ];
    }

    /**
     * Get the category associated with the product.
     */
    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
```

### Use Case 4

A hybrid use case (Use case 2 + Use case 3) containing both of the algorithms.

**products** table;

| Field1 | Field2 | Field3 | Field4 | Field5 |
| --- | --- | --- | --- | --- |
| id | color | material | price | category_id |

**category** table;

| Field1 | Field2 |
| --- | --- |
| id | name |

**order_products** table;

| Field1 | Field2 | Field3 | Field4 | Field5 | Field6 |
| --- | --- | --- | --- | --- | --- |
| id | order_id | product_id | product_count | created_at | updated_at |

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

    public static function getRecommendationConfig() :array
    {
        return [
            'sold_together' => [
                'recommendation_algorithm'         => 'db_relation',
                'recommendation_data_table'        => 'order_products',
                'recommendation_data_table_filter' => [],
                'recommendation_data_field'        => 'product_id',
                'recommendation_data_field_type'   => self::class,
                'recommendation_group_field'       => 'order_id',
                'recommendation_count'             => 5,
                'recommendation_order'             => 'random'
            ],
            'similar_products' => [
                'recommendation_algorithm'            => 'similarity',
                'similarity_feature_weight'           => 1,
                'similarity_numeric_value_weight'     => 1,
                'similarity_numeric_value_high_range' => 1,
                'similarity_taxonomy_weight'          => 1,
                'similarity_feature_attributes'       => [
                    'material', 'color'
                ],
                'similarity_numeric_value_attributes' => [
                    'price'
                ],
                'similarity_taxonomy_attributes'      => [
                    [
                        'category' => 'name'
                    ]
                ],
                'recommendation_count'                => 2,
                'recommendation_order'                => 'desc'
            ]
        ];
    }

    /**
     * Get the category associated with the product.
     */
    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
```

### Use Case 5

A use case for using with [Laravel Follow](https://github.com/overtrue/laravel-follow) package (User follow unfollow system for Laravel).

[Laravel Follow](https://github.com/overtrue/laravel-follow) package stores the data in `user_follower` table (Please check the [migration](https://github.com/overtrue/laravel-follow/blob/master/migrations/2020_04_04_000000_create_user_follower_table.php)). So, the implementation of the config function should be as follows;

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Umutphp\LaravelModelRecommendation\InteractWithRecommendation;
use Umutphp\LaravelModelRecommendation\HasRecommendation;

class User extends Model implements InteractWithRecommendation
{
    use HasFactory, HasRecommendation;

    public static function getRecommendationConfig() :array
    {
        return [
            'users_to_be_followed' => [
                'recommendation_algorithm'         => 'db_relation',
                'recommendation_data_table'        => 'user_follower',
                'recommendation_data_table_filter' => [],
                'recommendation_data_field'        => 'following_id',
                'recommendation_data_field_type'   => self::class,
                'recommendation_group_field'       => 'follower_id',
                'recommendation_count'             => 5
            ]
        ];
    }
}
```

**Function** calls;

```php
<?php
...

use App\Model\User;

User::generateRecommendations('users_to_be_followed');

$user1           = User::find(1);
$recommendations = $user1->getRecommendations('users_to_be_followed');

```

### Use Case 6

A use case for using with [Laravel Acquaintances](https://github.com/multicaret/laravel-acquaintances) package (to manage friendships (with groups), followships along with Likes, favorites etc.).

[Laravel Acquaintances](https://github.com/multicaret/laravel-acquaintances) package stores the data in `interactions` table (Please check the [migration](https://github.com/multicaret/laravel-acquaintances/blob/master/database/migrations/create_acquaintances_interactions_table.php)). So, the implementation of the config function should be as follows;

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Umutphp\LaravelModelRecommendation\InteractWithRecommendation;
use Umutphp\LaravelModelRecommendation\HasRecommendation;

class User extends Model implements InteractWithRecommendation
{
    use HasFactory, HasRecommendation;

    public static function getRecommendationConfig() :array
    {
        return [
            'users_to_follow' => [
                'recommendation_algorithm'         => 'db_relation',
                'recommendation_data_table'        => 'interactions',
                'recommendation_data_table_filter' => [
                    'relation' => 'follow' // possible values are follow/like/subscribe/favorite/upvote/downvote. Choose the one that you want to generate the recommendation for.
                ],
                'recommendation_data_field'        => 'subject_id',
                'recommendation_data_field_type'   => self::class,
                'recommendation_group_field'       => 'user_id',
                'recommendation_count'             => 5
            ]
        ];
    }
}
```

**Function** calls;

```php
<?php
...

use App\Model\User;

User::generateRecommendations('users_to_follow');

$user1           = User::find(1);
$recommendations = $user1->getRecommendations('users_to_follow');

```



## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
