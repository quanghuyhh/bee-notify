<?php

namespace Bee\Notify\Http\Listeners;

use Bee\Notify\Http\Notifications\WelcomeEmail;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmailNotification
{
    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        Log::info(sprintf("[%s][%s] WelcomeEmail", self::class, Carbon::now()), [$event]);
        if (!empty(optional($event->user)->first_visited_url) || !method_exists($event->user, 'notify')) {
            return;
        }

        Log::info("Send email");
        $event->user->notify(new WelcomeEmail);
    }
}
