<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    /**
     * @param  Student  $student
     */
    public function __construct(private readonly Student $student)
    {
    }

    /**
     * @param  array  $data
     * @return array
     */
    public function get(array $data): array
    {
        $page = !empty($data['page']) ? $data['page'] : 1;
        $offset = PER_PAGE * ($page - 1);

        return [
            'students' => $this->student->paginate($offset, PER_PAGE),
            'per_page' => PER_PAGE,
            'from' => $offset + 1,
            'to' => PER_PAGE * $page,
        ];
    }
}