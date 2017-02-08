<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HTMLServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \App::bind('build', function()
        {
            return new \App\Components\HtmlGenerator;
        });
    }
}
