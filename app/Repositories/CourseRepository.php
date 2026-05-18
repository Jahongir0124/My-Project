<?php


namespace app\Repositories;

use App\Models\Course;

class CourseRepository
{


    public function all()
    {
        return Course::latest()->paginate(10);
    }


    public function createMany($faculity, array $courses)
    {

        
        foreach($courses as $course)
            {
                $faculity->courses()->create([
                    "name" => $course
                ]);
            }
    }

    public function create(array $data)
    {
        $course = Course::create($data);
        return $course;
    }



    public function filter($data)
    {
        $course = Course::query();

       
        if ($data->name)
            {
                $course->where('name', 'like', '%' . $data->name .'%');
            }

        if ($data->departament_id)
            {
                $course->where('departament_id', $data->departemant_id);
            }

        if ($data->created_at) 
            {
                if ($data->created_at == 'latest')
                    {
                        $course->orderBy('created_at', 'desc');
                    }

                else
                    {
                        $course -> orderBy('created_at', 'asc');
                    }
            }

 
        return $course->paginate(10);
    }
}

