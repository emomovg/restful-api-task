<?php

namespace App\Services;

class CookieService
{
    /**
     * @param $key
     * @param $value
     * @param $exp
     * @return void
     */
    public static function set($key, $value, $exp): void
    {
        setcookie($key, $value, time() + $exp);
    }

    /**
     * @param $key
     * @return void
     */
    public static function remove($key): void
    {
        setcookie($key, '', time() - 3600);
    }
}