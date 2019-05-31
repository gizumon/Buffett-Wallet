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
        //Buy
        $this->app->bind(
            \App\Repositories\Buy\BuyRepositoryInterface::class,
            \App\Repositories\Buy\BuyRepository::class
        );
        //Sale
        $this->app->bind(
            \App\Repositories\Sale\SaleRepositoryInterface::class,
            \App\Repositories\Sale\SaleRepository::class
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