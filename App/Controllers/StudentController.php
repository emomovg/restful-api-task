<?php

namespace App\Controllers;

use App\Repositories\StudentRepository;

class StudentController extends Controller
{
    /**
     * @param  StudentRepository  $studentRepository
     */
    public function __construct(private readonly StudentRepository $studentRepository)
    {
    }

    /**
     * @return array
     */
    public function getStudents(): array
    {
        $data = $this->getQueryStringData();
        $students = $this->studentRepository->get($data);

        return self::response(200,'success', $students);
    }
}