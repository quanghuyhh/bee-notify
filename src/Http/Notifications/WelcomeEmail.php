<?php

namespace Bee\Notify\Http\Notifications;

use Bee\Notify\Helpers\ThemeHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class WelcomeEmail extends Notification
//    implements ShouldQueue
{
//    use Queueable;

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->buildMailMessage($notifiable);
    }

    /**
     *
     * @return MailMessage
     */
    protected function buildMailMessage($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Remind about Automatically Renewal'))
            ->theme(ThemeHelper::getTheme())
            ->template(ThemeHelper::getTemplate())
            ->markdown(ThemeHelper::getView('welcome-email'), [
                'user' => $notifiable
            ]);
    }
}
