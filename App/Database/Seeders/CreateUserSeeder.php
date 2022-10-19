<?php

namespace App\Database\Seeders;

use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $str = 'abcdefg';
        for ($i = 0; $i <= 10; $i++) {
            $userData[] = [
                str_shuffle($str),
                str_shuffle($str),
                str_shuffle($str).'@gmail.com',
                password_hash(substr(md5(rand()), 0, 7), PASSWORD_DEFAULT),
                uniqid(),
            ];
        }

        (new User())->create($userData);
    }
}