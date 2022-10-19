<?php

require_once 'config/database.php';
spl_autoload_register();

use App\Database\Seeders\CreateGroupSeeder;
use App\Database\Seeders\CreateStudentSeeder;
use App\Database\Seeders\CreateUserSeeder;

function run(): void
{
    (new CreateUserSeeder())->run();
    (new CreateGroupSeeder())->run();
    (new CreateStudentSeeder())->run();
}

run();