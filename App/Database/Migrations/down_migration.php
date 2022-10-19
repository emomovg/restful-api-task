<?php

spl_autoload_register();
require_once 'App/Database/Migrations/2022_10_17_110_create_users_table.php';
require_once 'App/Database/Migrations/2022_10_17_111_create_groups_table.php';
require_once 'App/Database/Migrations/2022_10_17_112_create_students_table.php';
require_once 'config/database.php';

function down(): void
{
    (new UsersTables())->down();
    (new StudentsTables())->down();
    (new GroupsTables())->down();
}

down();