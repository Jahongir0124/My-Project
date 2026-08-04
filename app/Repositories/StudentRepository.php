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
        $student->first_name = $data['first_name'];
        $student->last_name = $data['last_name'];
        $student->patrnomic = $data['patrnomic'];
        $student->save();
        return $student->fresh();
    }


    public function getTaskAnswer(int $group_id, $task_id)
    {
        

        $students = Student::where('group_id', $group_id)->with([
            'task_answers.rating'
        ])->get()->map(function ($student) use ($task_id) {
            $answer = $student->task_answers->firstWhere('task_id', $task_id);

            return [
                "id" => $student->id,
                "name" => $student->first_name . ' ' . $student->last_name,
                "submitted" => $answer ? true : false,
                "file" => $answer?->file_answer,
                "score" => $answer?->rating?->score,
                "answer_id" => $answer?->id,
                "rating_id" => $answer?->rating?->id,
                "rating_comment" => $answer?->rating?->comment
            ];
        });


        return $students;
    }


    public function getCourseData($studentId)
    {
        return Student::with([
            'group.courses' => function ($query) use ($studentId) {
                $query->withCount([
                    'attendances as count_attendance' => function ($q) use ($studentId){
                        $q->where('student_id', $studentId);
                    }
                ]);
            }
        ])->find($studentId);
    }


   
}

