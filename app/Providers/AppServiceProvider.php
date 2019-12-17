<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
Use Step;
Use Deal;
Use DB;
use Auth;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('layouts.admin', function($view)
        {
            $date = date('Y-m-d');
            $nextDay = date('Y-m-d', strtotime($date. ' + 1 days'));
            $dealss = DB::table('deals')
                ->join('steps', 'steps.deal_id', '=', 'deals.id')
                ->whereDate('steps.deal_start','=',$date)
                ->count();
            $dealss1 = DB::table('deals')
                ->join('steps', 'steps.deal_id', '=', 'deals.id')
                ->whereDate('steps.deal_start','=',$nextDay)
                ->count();
            $view->with(['dealss'=> $dealss, 'dealss1'=>$dealss1 ]);
        });
        view()->composer('layouts.member', function($view)
        {
            $id=Auth::user()->id;
            $date = date('Y-m-d');
            $nextDay = date('Y-m-d', strtotime($date. ' + 1 days'));
            $dealss = DB::table('deals')
                ->join('steps', 'steps.deal_id', '=', 'deals.id')
                ->whereDate('steps.deal_start','=',$date)
                ->where('deals.worker_id','=',$id)
                ->count();
            $dealss1 = DB::table('deals')
                ->join('steps', 'steps.deal_id', '=', 'deals.id')
                ->whereDate('steps.deal_start','=',$nextDay)
                ->where('deals.worker_id','=',$id)
                ->count();
            $view->with(['dealss'=> $dealss, 'dealss1'=>$dealss1 ]);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
