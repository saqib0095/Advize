<?php

namespace App\Providers;

use App\Services\BooksService;
use Illuminate\Support\ServiceProvider;

class BooksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BookService::class, function ($app) {
            return new BooksService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
