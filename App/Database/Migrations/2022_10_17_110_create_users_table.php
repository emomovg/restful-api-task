<?php

use App\Database\Migrations\Migration;

class UsersTables extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(): void
    {
        $statements = [
            'CREATE TABLE users
            (
                id SERIAL,
                login VARCHAR(255),
                name VARCHAR(255),
                email VARCHAR(255),
                password VARCHAR(255),
                token VARCHAR(255)
            );',
            'CREATE INDEX IX_login ON users (login);',
            'CREATE INDEX IX_token ON users (token);'
        ];

        foreach ($statements as $statement) {
            $this->connection->exec($statement);
        }
    }

    /**
     * Down the migrations.
     * @return void
     */
    public function down(): void
    {
        $this->connection->exec('DROP TABLE users');
    }
}