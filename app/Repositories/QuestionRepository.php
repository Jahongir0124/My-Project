<?php



namespace app\Repositories;

use App\Models\Question;

class QuestionRepository
{

    public function findById(int $id)
    {
        return Question::findOrFail($id);
    }
    public function store($exam_id, $title)
    {
        return Question::create([
            'exam_id' => $exam_id,
            'title' => $title
        ]);
    }
    
    public function getByName($name)
    {
        return Question::where('title', $name)->first();
    }


    public function insertData($data)
    {
        return Question::insert($data);
    }
}