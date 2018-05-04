<?php

namespace App\Providers;

use App\Site;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.report.partials.condition', function ($view) {
            $request = Request();
            $sites = Site::select('id', 'name')->get();
            $view->with([
                'sites'=> $sites,
                'site_id'=> $request->get('site_id') ? $request->get('site_id') : 0,
                'start_time'=> $request->get('start_time') ? $request->get('start_time') : 0,
                'end_time'=> $request->get('end_time') ? $request->get('end_time') : 0
            ]);
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
