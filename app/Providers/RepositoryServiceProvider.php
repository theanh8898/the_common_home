<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CategoryRepository::class, \App\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ArticleRepository::class, \App\Repositories\ArticleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MediaRepository::class, \App\Repositories\MediaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EntityMediaRepository::class, \App\Repositories\EntityMediaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\HomeRepository::class, \App\Repositories\HomeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CityRepository::class, \App\Repositories\CityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoomRepository::class, \App\Repositories\RoomRepositoryEloquent::class);
        //:end-bindings:
    }
}
