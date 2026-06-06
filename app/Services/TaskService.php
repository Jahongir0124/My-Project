<?php


namespace app\Services;

use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\Auth;



class TaskService
{
    public function __construct(protected readonly TaskRepository $taskRepository){}


    public function getTasksBySubject(int $subject_id)
    {
        return $this->taskRepository->getTasksBySubject($subject_id);
    }

    public function store($data)
    {
        $data['teacher_id'] = Auth::user()->teacher->id;
        
        try
            {
                $name = $data['file']->getClientOriginalName();
                $data['file_name'] = $name;
                $path = $data['file']->storeAs('tasks', $name, 'public');
            }
        catch (Exception $e) 
            {
                $path = null;
            }
        return $this->taskRepository->store($data, $path);
    }
}