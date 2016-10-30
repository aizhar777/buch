<?php

namespace App\Providers;

use App\Library\NumToString;
use Illuminate\Support\ServiceProvider;

class NumberToStringServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->regBladeDer();

        $this->app->singleton('NumberToString', function() {
            return $this->app->make(NumToString::class);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['NumberToString'];
    }

    public function regBladeDer()
    {
        \Blade::directive('numtostr', function($expression) {
            return '<?php echo NumberToString::getStr(' . $expression . '); ?>';
        });

        \Blade::directive('nts', function($expression) {
            return "<?php echo \\NumberToString::getStr({$expression}); ?>";
        });
    }
}
