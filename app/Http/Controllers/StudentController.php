<?php

namespace App\Http\Controllers;

use app\Services\ScheduleService;
use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Services\SemesterService;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    
     public function __construct(
        private StudentService $studentService,
        protected readonly ScheduleService $scheduleService,
        protected readonly SemesterService $semesterService,
        protected readonly TaskService $taskService
        ) {}



    
    public function index()
    {      
        return view('student-views.dashboard');
    }

    public function subjects(int $semester_id = null)
    {
        $group = Auth::user()->student->group;
      
        return view('student-views.subjects', [
            'schedules' => $this->scheduleService->getScheduleByGroup($group->id, $semester_id)->get(),
            'semesters' => $this->semesterService->all(),
            'group' => $group->id
            ]);

    }


    public function subjectSelect()
    {
        return view('student-views.subject-select');
    }

    public function subjectDetail(int $id)
    {
        return view('student-views.subject-detail', 
        [
            "tasks" => $this->taskService->getTasksBySubject($id)->get()
        ]);
    }

    
}
