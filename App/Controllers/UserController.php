<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Validations\LoginRequest;

class UserController extends Controller
{
    /**
     * @param  UserRepository  $userRepository
     */
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @return array
     */
    public function login(): array
    {
        $data = $this->getBody();
        $validation = new LoginRequest();

        if(!$validation->passes($data)) {
            return self::response(401, $validation->message());
        }

        $this->userRepository->login($data);

        return self::response(200,'success');
    }

    /**
     * @return array
     */
    public function logout(): array
    {
        $this->userRepository->logout();

        return self::response(200,'success');
    }
}