# Generate Recommendation List For Eloquent models

This package generates recommendation list for elequent models. It provides a simple API to work with to generate and list recommendations for a model.

Here are a few short examples of what you can do:

```php
$newsItem = News::find(1);
$newsItem->addMedia($pathToFile)->toMediaCollection('images');
```

\Umutphp\LaravelModelRecommendation\ModelRecommendationServiceProvider::class
