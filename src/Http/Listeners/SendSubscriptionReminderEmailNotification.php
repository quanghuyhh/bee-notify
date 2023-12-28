<?php

namespace Bee\Notify\Http\Listeners;

use Bee\Notify\Http\Events\SubscriptionRenewReminder;
use Bee\Notify\Http\Notifications\SubscriptionRefundedEmail;
use Bee\Notify\Http\Notifications\SubscriptionReminderEmail;

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
        $event->user->notify(new SubscriptionReminderEmail);
    }
}
