<?php



namespace app\Repositories;

use App\Models\ExamAttemp;

class ExamAttempRepository
{
    public function store(array $data)
    {
        return ExamAttemp::create($data);    
    }
    public function findById(int $id)
    {
        return ExamAttemp::findOrFail($id);
    }
    public function update(array $data)
    {
        $attempt = ExamAttemp::findOrFail($data['id']);
        $attempt->score = $data['score'];
        $attempt->correct_count = $data['correct_count'];
        $attempt->finished_at = now();
        $attempt->save();
        return $attempt;
    }


    public function getByExamStudent(int $exam_id)
    {
        
    }
}