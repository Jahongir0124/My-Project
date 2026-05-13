<?php


namespace app\Repositories;

use App\Models\Course;

class CourseRepository
{


    public function all()
    {
        return Course::latest()->paginate(5);
    }
}

