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
            $view->with('thongbaochuadoc', DB::table('thongbaos')->where('to->'. \Session::get('current_user')->id,'!=',1 )->get());
            // $view->with('your_var', \Session::get('var') );
        });

        // // su dung de truyen thong bao chua doc, de them vao include nav
        // $xxx = Session::get('current_user')->id;
        // // $notice_not_seen = DB::table('thongbaos')
        // //     ->where('to->'.Session::get('current_user')->id, '!=', 1)
        // //     ->get();
        // View::share('thongbaochuadoc', $xxx);
    }
}
