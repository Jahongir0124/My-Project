<?php


namespace app\Services;

use App\Repositories\StudentRepository;
use App\Models\Student;
use app\Repositories\GroupRepository;
use app\Repositories\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class StudentService 
{
    public function __construct(
        private StudentRepository $studentRepository,
        protected readonly UserRepository $userRepository,
        protected readonly GroupRepository $groupRepository
    ){}


    
    public function filter($data)
    {
        return $this->studentRepository->filter($data);
    }

    public function import(array $rows, $header)
    {
        foreach($rows as $row)
            {   
                $row = array_combine($header, $row);
                $user = Arr::only($row, ['name', 'email', 'password']);
                $student = Arr::except($row, ['name', 'email', 'password']);
                $user['role'] = 'student';
                $student['group_id'] = $this->groupRepository->getIdByName($student['group_id']);
                DB::transaction(function () use ($row, $user, $student) {
                    $userCreated = $this->userRepository->create($user);
                    $student['user_id'] = $userCreated->id;
                    $studentCreated = $this->studentRepository->create($student);
                });
            }

        return true;
    }


    public function store(array $data)
    {
        $user = Arr::only($data, ['name', 'email', 'password']);
        $student = Arr::except($data, ['name', 'email', 'password']);
        $user['role'] = 'student';
        return DB::transaction( function () use ($user, $student) {
            $userCreated = $this->userRepository->create($user);
            $student['user_id'] = $userCreated->id;
            $studentCreated = $this->studentRepository->create($student);
            return $studentCreated;
        });
    }

    public function destroy(int $id)
    {
        return $this->studentRepository->destroy($id);
    }


    public function update(array $data)
    {
        $id = Arr::only($data, ['id']);
        $student = Arr::except($data, ['id']);
        $this->studentRepository->update($id, $student);
    }

    public function getSubjects()
    {
        
    }
}