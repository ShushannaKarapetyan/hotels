<?php

use App\Services\Facades\NumberWord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/**
 * @param        $routes
 * @param string $output
 * @return string
 */
function active_route($routes, string $output = 'active')
{
    if (is_array($routes)) {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) {
                return $output;
            }
        }
    } else {
        if (strpos(Route::currentRouteName(), $routes) === 0) {
            return $output;
        }
    }

    return '';
}

/**
 * @param string $locale
 * @return string
 */
function available_locale(string $locale)
{
    return in_array($locale, config('app.locales')) ? $locale : 'en';
}

/**
 * @param $name
 * @return bool
 */
function lang($name)
{
    return app()->getLocale() . '_' . $name;
}

/**
 * Escape special characters for a LIKE query.
 *
 * @param string $value
 * @param string $char
 *
 * @return string
 */
function escape_like(string $value, string $char = '\\'): string
{
    return str_replace(
        [$char, '%', '_'],
        [$char . $char, $char . '%', $char . '_'],
        $value
    );
}

///**
// * @return array
// */
//function js_translations()
//{
//    return require_once base_path('resources/lang/js_translations.php');
//}
