<?php

namespace app\Services;

use App\Repositories\TeacherRepository;



class TeacherService
{

    public function __construct(protected readonly TeacherRepository $teacherRepository){}


    public function all()
    {
        return $this->teacherRepository->all();
    }

}

