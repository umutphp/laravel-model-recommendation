<?php

namespace Umutphp\LaravelModelRecommendation\Commands;

use Illuminate\Console\Command;

class LaravelModelRecommendationCommand extends Command
{
    public $signature = 'laravel_model_recommendation';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
