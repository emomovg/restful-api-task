<?php

namespace App\Models;

use App\Services\DBConnector;
use PDO;

class Model
{
    /**
     * @var string
     */
    protected string $table;

    /**
     * @var array
     */
    protected array $fillable;

    public function __construct()
    {
        $this->connection = DBConnector::getInstance()->connect();
    }

    /**
     * @return void
     */
    public function create($values): void
    {
        $placeholders = implode(',', array_fill(0, count($this->fillable), '?'));
        $columns = implode(',', $this->fillable);

        $statement = $this->connection->prepare(
            "INSERT INTO `{$this->table}` 
                 ({$columns}) VALUES ({$placeholders})"
        );
        foreach ($values as $value) {
            $statement->execute($value);
        }
    }

    /**
     * @param  string  $field
     * @param  int|string  $value
     * @return void
     */
    public function delete(string $field, int|string $value): void
    {
        $this->connection->query("DELETE FROM `{$this->table}` WHERE {$field} = '{$value}'");
    }

    /**
     * @param  array  $fields
     * @param  array  $values
     * @return void
     */
    public function update(array $fields, array $values): void
    {
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->connection->query("SELECT * FROM `{$this->table}`")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param  string  $field
     * @param  int|string  $value
     * @return array
     */
    public function getAllByField(string $field, int|string $value): array
    {
        return $this->connection->query(
            " SELECT * 
            FROM `{$this->table}` 
            WHERE {$field} = '{$value}'"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param  string  $field
     * @param  int|string  $value
     * @return array
     */
    public function getOneByField(string $field, int|string $value): array
    {
        $result = $this->connection->query(
            " SELECT * 
            FROM `{$this->table}`
            WHERE {$field} = '{$value}' LIMIT 1"
        )->fetchAll(PDO::FETCH_ASSOC);

        return $result ? $result[0] : [];
    }

    /**
     * @param  int  $offset
     * @param  int  $limit
     * @return array
     */
    public function paginate(int $offset, int $limit): array
    {
        return $this->connection->query(
            " SELECT * 
            FROM `{$this->table}` 
            LIMIT {$offset},{$limit}"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->connection
            ->query("SELECT COUNT(*) as `count` FROM `{$this->table}`")
            ->fetchAll()[0]['count'];
    }
}