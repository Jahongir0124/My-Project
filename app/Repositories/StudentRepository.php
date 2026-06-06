<?php


namespace App\Repositories;

use App\Models\User;
use App\Models\Student;


class StudentRepository {


    

    public function filter($data)
    {
        $student = Student::query();

        return $student;
    }


    public function create(array $student)
    {
        $query = Student::updateOrCreate([
            'user_id' => $student['user_id'],
            'first_name' => $student['first_name'],
            'last_name' => $student['last_name'],
            'group_id' => $student['group_id'],
            'patrnomic' => $student['patrnomic']
        ]);
        return $query;
    }


    public function destroy(int $id)
    {
        $student = Student::findOrFail($id);
        $student->user->delete();
        return $student->delete();
        
    }


    public function update($id, $data)
    {
        $student = Student::findOrFail($id);
        dd($student);
        // $student['first_name'] = $data['first_name'];
        // $student['last_name'] = $data['last_name'];
        // $student['patrnomic'] = $data['patrnomic'];
        // $student->save();
        return $student->fresh();
    }
}

