<?php


namespace app\Repositories;

use App\Models\Task;




class TaskRepository
{
    public function getTasksBySubject(int $subject_id)
    {
        return Task::where('schedule_id', $subject_id);
    }

    public function store(array $data, string $path = null)
    {   
        $task = Task::create($data);
        $task->file = $path;
        $task->save();
        return $task;
    }

    public function update(array $data)
    {
        $task = Task::findOrFail($data['id']);
        $task->update($data);
        return $task->fresh();
    }

    public function findById(int $id)
    {
        return Task::findOrFail($id);
    }

    public function destroy($task)
    {
        
        return $task->delete();
    }
}