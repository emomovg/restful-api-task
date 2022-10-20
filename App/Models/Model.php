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
        $this->connection->prepare(
            "DELETE FROM `{$this->table}` WHERE {$field}=?"
        )
            ->execute([$value]);
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
    public function getAllByField(string $field, int|string $value)
    {
        $sth = $this->connection->prepare(
            " SELECT * 
            FROM `{$this->table}` 
            WHERE {$field} =?"
        );
        $sth->execute([$value]);

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param  string  $field
     * @param  int|string  $value
     * @return array
     */
    public function getOneByField(string $field, int|string $value): array
    {
        $sth = $this->connection->prepare(
            " SELECT * 
            FROM `{$this->table}`
            WHERE {$field} =?  LIMIT 1"
        );
        $sth->execute([$value]);

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $result ? $result[0] : [];
    }

    /**
     * @param  int  $offset
     * @param  int  $limit
     * @return array
     */
    public function paginate(int $offset, int $limit): array
    {
        $sth = $this->connection->prepare(
            " SELECT * 
            FROM `{$this->table}` 
            LIMIT :limit OFFSET :offset "
        );
        $sth->bindParam(':limit', $limit, PDO::PARAM_INT);
        $sth->bindParam(':offset', $offset, PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
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