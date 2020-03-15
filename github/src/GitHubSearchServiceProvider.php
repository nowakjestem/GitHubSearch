<?php


namespace Nowakjestem\GitHub;


use Illuminate\Support\ServiceProvider;

class GitHubSearchServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config.php', 'github'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('github.php'),
        ]);
    }
}
