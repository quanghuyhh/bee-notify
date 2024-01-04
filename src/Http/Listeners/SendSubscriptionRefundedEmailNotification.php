<?php

namespace Bee\Notify\Http\Listeners;

use App\Events\TransactionRefunded;
use Bee\Notify\Http\Notifications\SubscriptionRefundedEmail;
use Bee\Notify\Http\Notifications\TransactionCompletedEmail;

class SendSubscriptionRefundedEmailNotification
{
    /**
     * Handle the event.
     *
     * @param  TransactionRefunded  $event
     * @return void
     */
    public function handle(TransactionRefunded $event)
    {
        $transaction = $event->transaction;
        $subscription = $transaction->subscription;
        $user = $subscription->user;
        if (empty($user) || !method_exists($user, 'notify')) {
            return;
        }
        $user->notify(new SubscriptionRefundedEmail($event->transaction));
    }
}
