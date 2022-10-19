<?php

use App\Database\Migrations\Migration;

class GroupsTables extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(): void
    {
        $statement = 'CREATE TABLE `groups`
            (
                id SERIAL, 
                name VARCHAR(255)
            );';
        $this->connection->exec($statement);
    }

    /**
     * Down the migrations.
     * @return void
     */
    public function down(): void
    {
        $this->connection->exec('DROP TABLE `groups`');
    }
}