<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Evaluation
        $this->app->bind(
            \App\Repositories\Evaluation\EvaluationRepositoryInterface::class,
            \App\Repositories\Evaluation\EvaluationRepository::class
        );
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

?>