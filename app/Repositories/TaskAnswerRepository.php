<?php

namespace app\Repositories;


use App\Models\TaskAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskAnswerRepository
{
    public function store(array $data)
    {
        return TaskAnswer::create($data);
    }


    public function findById(int $id)
    {
        return TaskAnswer::findOrFail($id);
    }

    public function update(int $task_answer_id, array $data)
    {
        $taskAnswer = TaskAnswer::findOrFail($task_answer_id);
        $taskAnswer->update($data);
        return $taskAnswer->fresh();
    }

    public function getByTaskStudent($Ids)
    {
        return TaskAnswer::with('rating')->where('student_id', Auth::user()->student->id)
        ->whereIn('task_id', $Ids);
    }


   



}