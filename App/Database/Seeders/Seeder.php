<?php

namespace App\Database\Seeders;

use App\Services\DBConnector;
use PDO;

abstract class Seeder
{
    /**
     * @var PDO
     */
    protected PDO $connection;

    public function __construct()
    {
        $this->connection = DBConnector::getInstance()->connect();
    }

    /**
     * @return void
     */
    abstract public function run(): void;
}