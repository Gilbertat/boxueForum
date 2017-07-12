<?php

namespace boxue\Markdown;

use Illuminate\Support\ServiceProvider;
use Event;
use App;

class MarkdownServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton('boxue\Markdown\Markdown', function ($app) {
            return new \boxue\Markdown\Markdown;
        });
    }


    public function provides()
    {
        return ['boxue\Markdown\Markdown'];
    }
}