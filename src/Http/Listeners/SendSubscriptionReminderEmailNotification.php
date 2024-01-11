<?php

namespace Bee\Notify\Http\Listeners;

use Bee\Notify\Http\Events\SubscriptionRenewReminder;
use Bee\Notify\Http\Notifications\SubscriptionRefundedEmail;
use Bee\Notify\Http\Notifications\SubscriptionReminderEmail;
use Illuminate\Support\Facades\Log;

class SendSubscriptionReminderEmailNotification
{
    /**
     * Handle the event.
     *
     * @param  SubscriptionRenewReminder  $event
     * @return void
     */
    public function handle(SubscriptionRenewReminder $event)
    {
        email_log(self::class, $event);
        if (empty($event->user) || !method_exists($event->user, 'notify')) {
            Log::info(sprintf("[%s][End][Not Process] dispatched", self::class), [$event]);
            email_log(self::class, $event, 'Unprocessed');
            return;
        }
        $event->user->notify(new SubscriptionReminderEmail);
        email_log(self::class, $event, 'Finished');
    }
}
