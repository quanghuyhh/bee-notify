<?php

namespace Bee\Notify\Http\Listeners;

use App\Events\TransactionCompleted;
use Bee\Notify\Http\Notifications\TransactionCompletedEmail;

class SendTransactionCompletedEmailNotification
{
    /**
     * Handle the event.
     *
     * @param  TransactionCompleted  $event
     * @return void
     */
    public function handle(TransactionCompleted $event)
    {
        $transaction = $event->transaction;
        $subscription = $transaction->subscription;
        $user = $subscription->user;
        if (empty($user) || !method_exists($user, 'notify')) {
            return;
        }
        $user->notify(new TransactionCompletedEmail($event->transaction));
    }
}
