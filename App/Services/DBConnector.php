<?php

namespace App\Services;

use PDO;

class DBConnector
{
    /**
     * @var PDO
     */
    private PDO $connect;

    /**
     * @var DBConnector
     */
    private static DBConnector $instance;

    public function __construct()
    {
        $host = DATABASE['host'];
        $port = DATABASE['port'];
        $dbName = DATABASE['dbname'];
        $userName = DATABASE['username'];
        $password = DATABASE['password'];

        $this->connect = new PDO(
            "mysql:host={$host};port={$port};dbname={$dbName}",
            $userName,
            $password
        );
    }

    /**
     * @return PDO
     */
    public function connect(): PDO
    {
        return $this->connect;
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}