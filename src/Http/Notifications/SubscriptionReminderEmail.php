<?php

namespace Bee\Notify\Http\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class SubscriptionReminderEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
    )
    {
    }

    /**
     *
     *
     * @param  string  $url
     * @return MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address Overwrite'))
            ->theme('bee-notify::vendor.mail.html.themes.abc')
            ->template('bee-notify::vendor.mail.html.message')
            ->markdown('bee-notify::email.subscription-reminder-email');
    }
}
