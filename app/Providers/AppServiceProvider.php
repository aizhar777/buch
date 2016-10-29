<?php

namespace App\Providers;

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
        $this->regBladeDirectives();
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

    public function regBladeDirectives()
    {
        \Blade::directive('perm', function($expression) {
            return "<?php if (in_array({$expression}, session('current.perms'))): ?>";
        });

        \Blade::directive('endperm', function($expression) {
            return "<?php endif; ?>";
        });

        \Blade::directive('currentUser', function($expression) {
            return "<?php (\\Session::has('current.user'))? session('current.user')->toArray()[{$expression}] : ''; ?>";
        });
    }
}
