<?php

namespace App\Database\Seeders;

use App\Models\Student;

class CreateStudentSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $str = 'abcdlmn';
        for ($i = 0; $i <= 10; $i++) {
            $studentData[] = [
                str_shuffle($str),
                str_shuffle($str),
                rand(18, 25),
                rand(1,4)
            ];
        }

        (new Student())->create($studentData);
    }
}