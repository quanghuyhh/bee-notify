<?php

namespace Bee\Notify\Http\Listeners;

use Bee\Notify\Http\Notifications\VerifyEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Log;

class SendEmailVerificationNotification
{
    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event): void
    {
        email_log(self::class, $event);
        $event->user->notify(new VerifyEmail);
        if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
            email_log(self::class, $event, 'Processed');
            $event->user->notify(new VerifyEmail);
        }
        email_log(self::class, $event, 'Finished');
    }
}
