<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    
    public function __construct(protected readonly TaskService $taskService){}


    public function store(TaskRequest $request)
    {
        
        $this->taskService->store($request->validated());
        return redirect()->back()->with('success', 'Created');
    }
}
