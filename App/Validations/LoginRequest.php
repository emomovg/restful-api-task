<?php

namespace App\Validations;

use App\Models\User;

class LoginRequest
{
    /**
     * @var string
     */
    private string $message;

    public function passes(array $data): bool
    {
        $login = $data['login'];
        $password = $data['password'];

        $user = (new User())->getOneByField('login', $login);

        if (!$user) {
            $this->message = 'Пользователя с таким логином не существует';
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            $this->message = 'Неправильно введен пароль';
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }
}