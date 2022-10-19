<?php

use App\Controllers\Controller;
use App\Controllers\StudentController;
use App\Controllers\UserController;
use App\Models\Student;
use App\Models\User;
use App\Repositories\StudentRepository;
use App\Repositories\UserRepository;
use App\Middleware\Authenticate;

$route = explode('/',
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[1];

$method = $_SERVER['REQUEST_METHOD'];

$userController = new UserController(new UserRepository(new User()));

$response = match ($route) {
    'auth' => match ($method) {
        'POST' => $userController->login(),
        'DELETE' => $userController->logout(),
        default => Controller::response(404, 'Route does not exists'),
    },
    'students' => match ($method) {
        'GET' => Authenticate::handle([new StudentController(new StudentRepository(new Student())), 'getStudents']),
        default => Controller::response(404,'Route does not exists'),
    },
    default => Controller::response(404, 'Route does not exists')
};

http_response_code($response['code']);

echo json_encode($response);