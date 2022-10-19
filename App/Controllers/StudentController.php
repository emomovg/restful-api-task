<?php

namespace App\Controllers;

use App\Models\Student;
use App\Repositories\StudentRepository;

class StudentController extends Controller
{
    /**
     * @param  StudentRepository  $studentRepository
     */
    private StudentRepository $studentRepository;

    public function __construct()
    {
        $this->studentRepository = new StudentRepository(new Student());
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