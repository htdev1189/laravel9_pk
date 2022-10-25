<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

//pagation bootstrap
use Illuminate\Pagination\Paginator;

//view
use Illuminate\Support\Facades\View;
use App\Models\Thongbao;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Paginator::useBootstrapFive();
        // Paginator::useBootstrapFour();


        view()->composer('*', function ($view) {
            if (\Session::has('current_user')) {
                $view->with('thongbaochuadoc', DB::table('thongbaos')->where('to->'. \Session::get('current_user')->id, '!=', 1)->get());
            }
        });
    }
}
