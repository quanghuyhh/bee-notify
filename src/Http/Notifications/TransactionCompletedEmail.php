<?php

namespace Bee\Notify\Http\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class TransactionCompletedEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Transaction $transaction,
    )
    {
    }

    /**
     *
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address Overwrite'))
            ->theme('bee-notify::vendor.mail.html.themes.abc')
            ->template('bee-notify::vendor.mail.html.message')
            ->markdown('bee-notify::email.transaction-completed-email');
    }
}
