<?php

namespace Bee\Notify\Helpers;

class ThemeHelper
{
    public static function getTheme(): string
    {
        return 'bee-notify::vendor.mail.html.themes.default';
    }

    public static function getTemplate()
    {
        return 'bee-notify::vendor.mail.html.message';
    }
}
