<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        View::composer(['payment.pages.edit'], 'App\Http\ViewComposers\Payments\StartComposer@composerData');
//        View::composer(['payment.pages.secondStep'], 'App\Http\ViewComposers\Payments\StartComposer@composerData');
//        View::composer(['payment.pages.thirdStep'], 'App\Http\ViewComposers\Payments\StartComposer@thirdStep');
    }
}
