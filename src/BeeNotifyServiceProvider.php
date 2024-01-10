<?php

namespace Bee\Notify;

use App\Events\TransactionCompleted;
use App\Events\TransactionRefunded;
use Bee\Notify\Http\Events\SubscriptionRenewReminder;
use Bee\Notify\Http\Listeners\SendEmailVerificationNotification as ReplaceSendEmailVerificationNotification;
use Bee\Notify\Http\Listeners\SendSubscriptionRefundedEmailNotification;
use Bee\Notify\Http\Listeners\SendSubscriptionReminderEmailNotification;
use Bee\Notify\Http\Listeners\SendTransactionCompletedEmailNotification;
use Bee\Notify\Http\Listeners\SendWelcomeEmailNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification as OriginalSendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class BeeNotifyServiceProvider extends ServiceProvider
{
    protected array $overwriteAliases = [
        OriginalSendEmailVerificationNotification::class => ReplaceSendEmailVerificationNotification::class,
    ];
    /**
     * 1. Chào mừng khàch hàng đến với website
     * 2. Forgot Password
     * 3. Email nhắc đến kỳ gia hạn trước 3 ngày
     * 4. Thông báo huỷ gia hạn thành công
     * 5. Gửi bill  cho khách hàng
     * @var array[]
     */
    protected $listen = [
        Login::class => [
            SendWelcomeEmailNotification::class,
        ],
        PasswordReset::class => [

        ],

        SubscriptionRenewReminder::class => [
            SendSubscriptionReminderEmailNotification::class,
        ],

        TransactionRefunded::class => [
            SendSubscriptionRefundedEmailNotification::class,
        ],

        TransactionCompleted::class => [
            SendTransactionCompletedEmailNotification::class,
        ],
    ];

    const PACKAGE_NAMESPACE = 'bee-notify';

    /**
     * Register services.
     */
    public function register(): void
    {
        parent::register();
        $this->registerOverwriteAliases();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->offerPublishing();

        $this->registerResources();
        $this->registerMigrations();
    }

    private function registerResources(): void
    {
        $newMarkdownPaths = array_merge(
            config('mail.markdown.paths'),
            [__DIR__.'/../resources/views/vendor/mail/html']
        );
        $theme = config('app.theme');

        $this->loadViewsFrom(__DIR__.'/../resources/views', self::PACKAGE_NAMESPACE);
        if (!empty($theme)) {
            $this->loadViewsFrom(base_path("themes/{$theme}/resources/views"), self::PACKAGE_NAMESPACE);
//            $newMarkdownPaths = array_merge(
//                $newMarkdownPaths,
//                [base_path("themes/{$theme}/resources/views/vendor/mail/html")]
//            );
        }


        config(['mail.markdown.paths' => $newMarkdownPaths]);
    }

    protected function offerPublishing(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }
    }

    public function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations/');
    }

    protected function registerOverwriteAliases(): void
    {
        foreach ($this->overwriteAliases as $oldAlias => $newAlias) {
            $this->app->alias($newAlias, $oldAlias);
        }
    }

    public function registerComponents()
    {
        $components = [];
    }
}
