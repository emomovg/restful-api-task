<?php

namespace App\Database\Migrations;

use App\Services\DBConnector;
use PDO;

abstract class Migration
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
    abstract public function up(): void;

    /**
     * @return void
     */
    abstract public function down(): void;
}