<?php

use App\Routes\Router;

/**
 * @return array
 */
function runApiRoutes(): array
{
    $router = new Router();

    $router->post('/auth', \App\Controllers\UserController::class.'::login');
    $router->delete('/auth', \App\Controllers\UserController::class.'::logout');
    $router->get('/students', \App\Controllers\StudentController::class.'::getStudents')
        ->middleware('\App\Middleware\Authenticate');

    return $router->run();
}