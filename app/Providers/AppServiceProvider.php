<?php

namespace App\Providers;

use App\Guards\SecretKeyGuard;
use Illuminate\Support\Facades\Auth;
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
        $this->registerSidebar();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('secret', function ($app, $name, array $config) {
            return new SecretKeyGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
        });
    }

    /**
     *
     *
     * @return  void
     */
    private function registerSidebar()
    {
        \View::composer('partials.sidebar', function ($view) {
            $user         = auth()->user();
            $currentRoute = request()->route()->getName();
            $userLetter   = ucfirst($user->name[0]);

            $view->with(compact('user', 'currentRoute'));
        });
    }
}
