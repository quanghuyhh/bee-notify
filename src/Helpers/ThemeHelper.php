<?php

namespace Bee\Notify\Helpers;

class ThemeHelper
{
    public static function getTheme($style = 'default'): string
    {
        try {
            if (!self::hasChildTheme()) {
                throw new \Exception('Child theme not used');
            }
            $theme = config('app.theme');
            $childThemePath = base_path("themes/{$theme}/resources/views/vendor/mail/html/themes/" . strtolower($theme) . ".css");
            if (!file_exists($childThemePath)) {
                throw new \Exception('Use default theme style');
            }

            return 'bee-notify::vendor.mail.html.themes.' . strtolower($theme);
        } catch (\Exception $exception) {
            return 'bee-notify::vendor.mail.html.themes.default';
        }
    }

    public static function getTemplate()
    {
        return 'bee-notify::vendor.mail.html.message';
    }

    public static function getView($name)
    {
        $theme = config('app.theme');
        $childThemePath = base_path("themes/{$theme}/resources/views");
        $viewPath = sprintf("%s/email/%s.blade.php", $childThemePath, $name);
        if (!file_exists($viewPath)) {
            return sprintf('bee-notify::email.%s', $name);
        }
        return sprintf("email.%s", $name);
    }

    public static function hasChildTheme()
    {
        $theme = config('app.theme');
        $childThemePath = base_path("themes/{$theme}/resources/views");
        return is_dir($childThemePath);
    }
}
