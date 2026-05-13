<?php


namespace app\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    public function __construct(protected readonly CourseRepository $courserepostirory){}
    



    public function all()
    {
        return $this->courserepostirory->all();
    }
}