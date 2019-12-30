<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        // force https if app debug false
        if(config('app.debug')!=true) {
            URL::forceScheme('https');
        }

        // default string length 191 character
        Schema::defaultStringLength(191);

        // make blade directive to asset
        Blade::directive('asset', function($asset) {
            return "<?php echo asset($asset); ?>";
        });

        // make blade directive to check active menu
        Blade::directive('active', function($data) {
            $results = explode(',', $data);
            $count = count($results);
            $output = "";

            if($count == 1){
                $output = "{{ Request::route()->getName() == $results[0] ? 'active' : '' }}";
            } else if($count == 2 && $results[1] == "'prefix'"){
                $output = "{{ Request::route()->getPrefix() == $results[0] ? 'active' : '' }}";
            }
            return $output;
        });

        // make blade directive to route
        Blade::directive('route', function($route) {
            return "<?php echo route($route); ?>";
        });
    }
}
