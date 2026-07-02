<?php



namespace app\Repositories;

use App\Models\Exam;

class ExamRepository
{

    public function exams()
    {
        
    }
    public function store(array $data)
    {
        return Exam::create($data);
    }

    public function examByTeacher(int $teacher_id)
    {
        return Exam::whereHas('course', function ($query) use ($teacher_id) {
            $query->where('teacher_id', $teacher_id);
        })->with('course')->get();
    }


    public function examsByGroup(int $group_id)
    {
        return Exam::whereHas('course', function ($query) use ($group_id){
            $query->where('group_id', $group_id);
        })->with('course')->get();
    }

    public function examsByStudent(int $student_id)
    {
        return Exam::with([
            'course',
            'examAttempts' => fn($q) =>
            $q->where('student_id', $student_id)
        ])->get();

    }
    public function edit(array $data)
    {
        $exam = Exam::findOrFail($data['id']);
        $exam->update($data);
        return $exam->fresh();
    }

    public function destroy($exam)
    {
        return $exam->delete();
    }


    public function findById(int $id)
    {
        return Exam::findOrFail($id);
    }
}