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
        email_log(self::class, $event);
        if (!empty(optional($event->user)->first_visited_url) || !method_exists($event->user, 'notify')) {
            email_log(self::class, $event, 'Unprocessed');
            return;
        }

        $event->user->notify(new WelcomeEmail);
        email_log(self::class, $event, 'Finished');
    }
}
