<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class LogoutListener
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        cookie()->expire('unique_session');
    }
}
