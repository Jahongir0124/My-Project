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
        $students = $this->ratingService->ratingTask($task);
        return view('teacher.rating', [
            'students' => $students,
            'task' => $task
            ]);
    }


    public function store(Request $request)
    {
        $this->ratingService->store($request);
        return redirect()->back()->with('succses', 'Created');
    }

    public function update(Request $request)
    {
        $this->ratingService->update($request);
        return redirect()->back()->with('success', 'Updated');
    }
}
