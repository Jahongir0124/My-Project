<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScheduleService;
use Illuminate\Support\Facades\Auth;


class TeacherController extends Controller
{

    public function __construct(protected readonly ScheduleService $scheduleService) {}
    public function index()
    {
        return view('teacher.dashboard');
    }


    public function subjects()
    {
        return view('teacher.subjects', ['courses' => Auth::user()->teacher->courses]);
    }


    public function taskCrete() {}
}
