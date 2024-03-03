<?php

namespace App\Listeners;

use App\Models\Session;
use App\Services\CartServiceInterface;
use App\Services\SessionService;
use Illuminate\Auth\Events\Login;

class LoginListener
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        if ($user->sessions()->latest()->first()) {
            $currentCartProducts = app(CartServiceInterface::class)
                ->getCurrentCart(Session::query()->where('name', $_COOKIE['unique_session'])->latest()->first())
                ->products();
            $userCartProducts = app(CartServiceInterface::class)->getCurrentCart($event->user->sessions()->latest()->first())->products();
            $diffProducts = $currentCartProducts->get()->diff($userCartProducts->get());
            foreach ($diffProducts as $diffProduct) {
                $userCartProducts->attach([$diffProduct->id => ['count' => $diffProduct->pivot->count]]);
            }
            $diffForSession = $userCartProducts->get()->diff($currentCartProducts->get());

            foreach ($diffForSession as $diffProduct) {
                $currentCartProducts->attach([$diffProduct->id => ['count' => $diffProduct->pivot->count]]);
            }
        }else {
            SessionService::getCurrentSession()->update(['user_id' => $user->id]);
        }
    }
}
