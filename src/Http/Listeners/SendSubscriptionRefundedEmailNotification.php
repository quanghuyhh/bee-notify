<?php

namespace Bee\Notify\Http\Listeners;

use App\Events\TransactionRefunded;
use Bee\Notify\Http\Notifications\SubscriptionRefundedEmail;
use Bee\Notify\Http\Notifications\TransactionCompletedEmail;
use Illuminate\Support\Facades\Log;

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
        email_log(self::class, $event);
        $transaction = $event->transaction;
        $subscription = $transaction->subscription;
        $user = $subscription->user;
        if (empty($user) || !method_exists($user, 'notify')) {
            email_log(self::class, $event, 'Unprocessed');
            return;
        }
        $user->notify(new SubscriptionRefundedEmail($event->transaction));
        email_log(self::class, $event, 'Finished');
    }
}
