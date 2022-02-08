<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\PersonRepositoryInterface;
use App\Repositories\PersonRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PersonRepositoryInterface::class, PersonRepository::class);
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
