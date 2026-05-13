<?php


namespace app\Services;

use App\Repositories\StudentRepository;

class StudentService 
{
    public function __construct(private StudentRepository $repo ){}


    public function getStudent($id)
    {
        return $this->repo->find($id);
    }
}