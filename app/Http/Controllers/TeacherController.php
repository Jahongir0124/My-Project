<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangeImageRequest;
use App\Http\Requests\User\ChanngePasswordRequest;
use Illuminate\Http\Request;
use App\Services\ScheduleService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;


class TeacherController extends Controller
{

    public function __construct(
        protected readonly ScheduleService $scheduleService,
        protected readonly UserService $userService
        
        ) {}
    public function index()
    {
        return view('teacher.dashboard');
    }


    public function subjects()
    {
        return view('teacher.subjects', ['courses' => Auth::user()->teacher->courses]);
    }


    public function taskCrete() {}

    public function profile()
    {
        return view('teacher.profile', ['user' => Auth::user()]);
    }

    public function changePassword(ChanngePasswordRequest $request)
    {
        $this->userService->changePassword($request->validated(), Auth::user());
        return redirect()->route('teacher.index');
    }

    public function changeLanguage(Request $request)
    {
        $data = $request->validate([
            'lang' => ['required', 'string']
        ]);

        $this->userService->changeLanguage($data, Auth::user());
        return redirect()->route('teacher.index');
    }
    public function changeImage(ChangeImageRequest $request)
    {
        $this->userService->changeImage($request->validated(), Auth::user());
        return redirect()->route('teacher.index');
    }
}
