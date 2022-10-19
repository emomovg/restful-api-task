<?php

namespace App\Middleware;

use App\Controllers\Controller;
use App\Models\User;

class Authenticate
{
    /**
     * @param  callable  $callback
     * @return mixed
     */
    public static function handle(callable $callback): mixed
    {
        if (empty($_SESSION['auth']) || $_SESSION['auth'] === false) {
            if (empty($_COOKIE['token']) || !(new User())->getOneByField('token',$_COOKIE['token'])) {
              return  Controller::response(403,'Forbidden');
            }
        }

        return $callback();
    }
}