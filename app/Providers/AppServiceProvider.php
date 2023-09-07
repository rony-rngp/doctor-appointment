<?php

namespace App\Providers;

use App\Models\Cms;
use App\Models\Settings;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Settings::findOrFail(1);
        $cms_pages = Cms::where('status', 1)->get();
        View::share(['settings'=> $settings, 'cms_pages'=> $cms_pages]);
    }
}
