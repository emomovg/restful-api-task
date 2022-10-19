<?php

use App\Database\Migrations\Migration;

class StudentsTables extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(): void
    {
        $statements = [
            'CREATE TABLE students
            (
                id SERIAL,
                name VARCHAR(255),
                surname VARCHAR(255),
                age INTEGER,
                group_id BIGINT UNSIGNED,
                CONSTRAINT fk_student_group_id
                FOREIGN KEY (group_id)
                REFERENCES `groups` (id)
            );',
            'CREATE INDEX IX_personal_info ON students (name, surname);'
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
        $this->connection->exec('DROP TABLE students');
    }
}