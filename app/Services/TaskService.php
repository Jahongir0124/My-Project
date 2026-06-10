<?php


namespace app\Services;

use app\Repositories\ScheduleRepository;
use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;



class TaskService
{
    public function __construct(
        protected readonly TaskRepository $taskRepository,
        protected readonly ScheduleRepository $scheduleRepository
        ){}


    
    public function getTasksBySubject(int $subject_id)
    {
        return $this->taskRepository->getTasksBySubject($subject_id);
    }

    public function checkScore(int $schedule_id)
        {
            $sum = 0;
            $schedule = $this->scheduleRepository->findById($schedule_id);
            foreach($schedule->tasks as $task)
                {
                    $sum += $task->score;
                }
            return ['score' => $schedule->course->score_course - $sum];
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

        $scoreMax = ($this->checkScore($data['schedule_id']))['score'];
       
        if ($scoreMax < $data['score'] || $data['score'] == 0)
            {
                throw ValidationException::withMessages([
                    "score" => "Yangi vazifaga $scoreMax ball berish mumkin! vazifa ball 0 bo'lishi mumkin emas"   
                ]);
            }
        return $this->taskRepository->store($data, $path);
    }

    
    public function update($request)
    {
        $data = $request->validate([
            "id" => "required|integer|exists:tasks,id",
            "deadline" => "required|date",
            "file" => "nullable|file|mimes:pdf,docx,xlsx,zip,rar,jpg,png",
            "score" => "nullable|integer"
        ]);
        if ($request->hasFile('file'))
            {
                $task = $this->taskRepository->findById($data['id']);
                if ($task->file)
                    {
                        Storage::delete($task->file);
                    }
                $data['file_name'] = $data['file']->getClientOriginalName();
                $data['file'] = $data['file']->store('tasks', 'public');
            }   
        return $this->taskRepository->update($data);
    }

    public function destroy($task)
    {
        
        if (!empty($task->file))
            {
                Storage::disk('public')->delete($task->file);
            }
        return $this->taskRepository->destroy($task);
    }

   
}