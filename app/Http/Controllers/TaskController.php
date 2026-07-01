<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Task;
use app\Services\ScheduleService;

class TaskController extends Controller
{

    public function __construct(
        protected readonly TaskService $taskService,
        protected readonly ScheduleService $scheduleService
    ) {}


    public function tasksBySubject(Course $course)
    {
        return view('teacher.tasks', [
            'tasks' => $course->tasks,
            'course' => $course->id
        ]);
    }
    public function store(TaskRequest $request)
    {

        $this->taskService->store($request->validated());
        return redirect()->back()->with('success', 'Created');
    }

    public function update(Request $request)
    {
        $this->taskService->update($request);
        return redirect()->back()->with('success', 'Updated');
    }

    public function destroy(Task $task)
    {
        $this->taskService->destroy($task);
        return redirect()->back()->with('success', 'Deleted');
    }
}
