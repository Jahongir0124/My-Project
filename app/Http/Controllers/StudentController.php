<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\DayService;
use App\Services\ExamService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Services\SemesterService;
use App\Services\TaskService;
use App\Services\GroupService;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function __construct(

        protected readonly ScheduleService $scheduleService,
        protected readonly SemesterService $semesterService,
        protected readonly TaskService $taskService,
        protected readonly GroupService $groupService,
        protected readonly DayService $dayService,
        protected readonly StudentService $studentService,
        protected readonly ExamService $examService

    ) {}

    public function index()
    {
        return view('student-views.dashboard');
    }

    public function subjects(int $semester_id = null)
    {
        $group = Auth::user()->student->group;

        return view('student-views.subjects', [
            'courses' => $this->studentService->getSubjects(Auth::user()->student->id)->group->courses,
            'group' => $group->id,
            'semesters' => $this->semesterService->all()
        ]);
    }
    public function subjectSelect()
    {
        return view('student-views.subject-select');
    }

    public function subjectDetail(Course $course)
    {

        return view(
            'student-views.subject-detail',
            [
                "tasks" => $course->tasks,
                "indicators" => $this->taskService->indicators($course->id)
            ]
        );
    }

    public function schedule()
    {
        $group = Auth::user()->student->group;
        return view(
            'student-views.schedule',
            ['group_semesters' => $group->group_semesters]
        );
    }


    public function scheduleDetail(int $group_semester_id)
    {
        $group_semester = $this->groupService->findByIdGroupSemester($group_semester_id);
        return view('student-views.schedule-detail', [
            "schedules" => $this->scheduleService->getScheduleByGroupSemester($group_semester->id)['schedulesMap'] ?? [],
            'pairs' => $this->scheduleService->getScheduleByGroupSemester($group_semester->id)['pairs'] ?? [],
            'days' => $this->dayService->days(),
            'group_semester' => $group_semester
        ]);
    }

    public function exams()
    {
        $exams = $this->examService->examsByGroup(Auth::user()->student->group->id);
        return view('student-views.exams', [
            'exams' => $exams
        ]);
    }

    
}
