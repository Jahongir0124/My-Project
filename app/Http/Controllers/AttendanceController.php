<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attendance\AttendanceRequest;
use App\Models\Course;
use App\Services\AttendanceService;
use App\Services\CourseService;
use Carbon\Carbon;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
{
    
    public function __construct(
        
        protected readonly AttendanceService $attendanceService)
    {}

    public function create(Course $course)
    {
        return view('teacher.attendance-create', [
            "students" => $course->group->students,
            'course' => $course,
            "day" => Carbon::now()
        ]);
    }
    public function store(AttendanceRequest $request)
    {
        $this->attendanceService->store($request->validated());
        return redirect()->route('teacher.attendance.index');
    }

    public function index()
    {
        return view(
            'teacher.attendance', 
            [
                "courses" => Auth::user()->teacher->courses
            ]
        );
    }

    public function getAttendanceByCourse(Course $course)
    {
        return view(
            'teacher.lesson',
            [
                'lessons' => $course->attendances,
                'course' => $course
            ]
        );
    }



}
