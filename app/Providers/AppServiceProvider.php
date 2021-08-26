<?php

namespace App\Providers;

use App\Contracts\BillerInterface;
use App\Foundations\Biller;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryEloquent;
use Illuminate\Support\Facades\App;
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
        App::bind(OrderRepository::class, OrderRepositoryEloquent::class);
        App::bind(BillerInterface::class, Biller::class);
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
