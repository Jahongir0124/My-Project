<?php


namespace app\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    public function __construct(protected readonly CourseRepository $courseRepostirory){}
    



    public function all()
    {
        return $this->courseRepostirory->all();
    }


    public function create(array $data)
    {
        return $this->courseRepostirory->create($data);
    }


    public function filter($data)
    {
        return $this->courseRepostirory->filter($data);
    }

    public function update(array $data)
    {   
        $id = $data['id'];
        unset($data['id']);
        return $this->courseRepostirory->update($id, $data);
    }



    public function destroy(int $id)
    {
        $this->courseRepostirory->destroy($id);
    }


    public function getCourseByDepartament($departament)
    {
        return $this->courseRepostirory->getCourseByDepartament($departament);
    }
}