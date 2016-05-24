<?php

namespace Pixelpeter\Genderize;

use Illuminate\Support\ServiceProvider;

class GenderizeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/genderize.php', 'genderize');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('Pixelpeter\Genderize\GenderizeClient', function () {
            return new GenderizeClient(new \Unirest\Request);
        });

        $app->alias('Pixelpeter\Genderize\GenderizeClient', 'genderize');
    }
}
