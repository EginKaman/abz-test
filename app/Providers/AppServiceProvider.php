<?php

namespace App\Providers;

use Faker\{Factory, Generator};
use Illuminate\Support\ServiceProvider;
use Xvladqt\Faker\LoremFlickrProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new LoremFlickrProvider($faker));
            return $faker;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
