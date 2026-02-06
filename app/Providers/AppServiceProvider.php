<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        // Implicitly grant "Super Admin" role all permissions
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });
        
        // Share cart with navigation menu on all pages
        View::composer('navigation-menu', function ($view) {
            $cartNav = null;
            if (Auth::check()) {
                $cartNav = Cart::where('user_id', Auth::id())->with('items')->first();
            }
            $view->with('cartNav', $cartNav);
        });
    }
}
