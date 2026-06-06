<?php

namespace app\Services;

use App\Repositories\TeacherRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class TeacherService
{

    public function __construct(
        protected readonly TeacherRepository $teacherRepository,
        protected readonly UserRepository $userRepository
        ){}


    public function all()
    {
        return $this->teacherRepository->all();
    }


    public function create(array $data)
    {   

    
        $user = Arr::only($data, ['name', 'email', 'password']);
        $teacher = Arr::except($data, ['name', 'email', 'password']);
        $user['role'] = 'teacher';
        return DB::transaction(function () use ($user, $teacher) {
            $userCreated = $this->userRepository->create($user);
            $teacher['user_id'] = $userCreated->id;
            $teacher['full_name'] = $teacher['first_name'] . " " . $teacher['last_name']; 
            $teacherCreated = $this->teacherRepository->create($teacher);
            return $teacherCreated->load('user');
        });
    }


    public function destroy(int $id)
    {
        return $this->teacherRepository->destroy($id);
    }

    public function update(array $data)
    {
        
        $id = $data['id'];
        $data = Arr::except($data, ['id']);
        return $this->teacherRepository->update($id, $data);
    }


    public function filter($data)
    {
        return $this->teacherRepository->filter($data);
    }

    public function getTeacherByDepartament($departament)
    {
        return $this->teacherRepository->getTeacherByDepartament($departament);
    }

}

