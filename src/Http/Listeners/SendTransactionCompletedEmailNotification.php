<?php

namespace Bee\Notify\Http\Listeners;

use App\Events\TransactionCompleted;
use Bee\Notify\Http\Notifications\TransactionCompletedEmail;
use Illuminate\Support\Facades\Log;

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
        email_log(self::class, $event);
        $transaction = $event->transaction;
        $subscription = $transaction->subscription;
        $user = $subscription->user;
        if (empty($user) || !method_exists($user, 'notify')) {
            email_log(self::class, $event, 'Unprocessed');
            return;
        }
        $user->notify(new TransactionCompletedEmail($event->transaction));
        email_log(self::class, $event, 'Finished');
    }
}
