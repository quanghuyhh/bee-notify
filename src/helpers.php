<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

if (! function_exists('email_log')) {
    function email_log($notifyClass, $event, $type = 'Start'): void
    {
        Log::info(sprintf("[%s][%s] dispatched", $notifyClass, $type), [$event]);
    }
}
