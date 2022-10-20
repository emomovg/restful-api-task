<?php

namespace App\Models;

class User extends Model
{
    /**
     * @var string
     */
    protected string $table = 'users';

    /**
     * @var array|string[]
     */
    protected array $fillable = [
        'login',
        'name',
        'email',
        'password',
        'token'
    ];

    /**
     * @param  string  $login
     * @param  string  $token
     * @return void
     */
    public function updateTokenByLogin(string $login, string $token): void
    {
        $this->connection->prepare(
            "
            UPDATE {$this->table} 
                SET token=?
            WHERE login=?"
        )->execute([$token, $login]);
    }
}