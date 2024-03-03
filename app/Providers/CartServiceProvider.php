<?php

namespace App\Providers;

use App\Models\Session;
use App\Services\CartServiceInterface;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('layouts.header', function () {
            if (!array_key_exists('unique_session', $_COOKIE)) {
                $id = session()->getId();
                setcookie('unique_session', $id, 2147483647);
                $session = Session::query()->where('name', $id)->first();
                if (!$session) {
                    Session::query()->firstOrCreate(['name' => $id]);
                }
            } else {
                Session::query()->where('name', $_COOKIE['unique_session'] ?? session()->getId())->latest()->first();
            }
        });
    }
}
