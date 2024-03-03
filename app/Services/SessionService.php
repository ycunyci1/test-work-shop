<?php

namespace App\Services;

use App\Models\Session;

class SessionService
{
    public static function getCurrentSession(): Session
    {
        $user = auth()->user();
        if ($user) {
            $session = $user->sessions()->latest()->first();
        } else {
            $session = array_key_exists('unique_session', $_COOKIE) ? Session::query()->where('name', $_COOKIE['unique_session'])->latest()->first() : null;
        }
        if (!$session) {
            $session = Session::query()->create(['name' => $_COOKIE['unique_session'] ?? session()->getId()]);
        }
        return $session;
    }
}
