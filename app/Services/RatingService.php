<?php


namespace app\Services;

use App\Repositories\RatingRepository;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TaskAnswerRepository;
use Illuminate\Validation\ValidationException;

class RatingService
{
    public function __construct(
        protected readonly RatingRepository $ratingRepository,
        protected readonly StudentRepository $studentRepository,
        protected readonly TaskAnswerRepository $taskAnswerRepository
        ){}


    public function ratingTask($task)
    { 
        return $this->studentRepository->getTaskAnswer($task->schedule->group->id, $task->id); 
    }
    public function store($request)
    {
        $data = $request->validate([
            "task_answer_id" => "required|integer|exists:task_answers,id",
            "score" => "required|integer|min:0",
            "comment" => "nullable|string" 
        ]);
        $data['teacher_id'] = Auth::user()->teacher->id;

        $scoreTask = $this->taskAnswerRepository->findById($data['task_answer_id'])->task->score;

        if ($data['score'] <= $scoreTask)
            {
                return $this->ratingRepository->store($data);
            }

        throw ValidationException::withMessages([
                "score" => "Kiritgan ball vazifani balidan yuqori!"
        ]);

    }
}