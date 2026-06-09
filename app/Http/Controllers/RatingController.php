<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\RatingService;
use Illuminate\Http\Request;


class RatingController extends Controller
{
    
    public function __construct(protected readonly RatingService $ratingService){}

    public function ratingTask(Task $task)
    {
        return view('teacher.rating', ['task_answers' => $task->task_answers]);
    }
}
