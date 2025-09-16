<?php

namespace DazzaDev\CaptchaSolver;

use Illuminate\Support\ServiceProvider;

class CaptchaSolverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/captcha-solver.php' => config_path('captcha-solver.php'),
        ], 'captcha-solver');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/captcha-solver.php',
            'captcha-solver'
        );
    }

    public function register()
    {
        $this->app->bind('captcha_solver', function ($app, $params) {
            return new CaptchaSolverClient($params);
        });
    }

    public function provides()
    {
        //
    }
}
