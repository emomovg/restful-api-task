<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\CookieService;
use App\Services\Logger;

class UserRepository
{
    /**
     * @param  User  $user
     */
    public function __construct(private readonly User $user){}

    /**
     * @param  array  $data
     * @return void
     */
    public function login(array $data):void
    {
        $_SESSION['auth'] = true;
        $login = $data['login'];

        if (isset($data['remember']) && $data['remember'] === true) {
            $token = uniqid();
            CookieService::set('token', $token,COOKIE_LIVE_TIME);
            $this->user->updateTokenByLogin($login,$token);
        }

        Logger::info('Пользователь '.$login.' залогинился в '. date('Y-m-d H:i:s'),'auth');
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        if(!empty($_SESSION['auth']) && $_SESSION['auth']) {
            unset($_SESSION['auth']);
        }

        CookieService::remove('token');
    }
}