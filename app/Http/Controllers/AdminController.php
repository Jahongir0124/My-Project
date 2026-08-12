<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Http\Requests\Admin\Group\GroupRequest;
use App\Http\Requests\Admin\Group\UpdateGroupRequest;
use App\Http\Requests\User\ChangeImageRequest;
use App\Http\Requests\User\ChanngePasswordRequest;
use App\Models\Group;
use App\Services\CourseService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;




class AdminController extends Controller
{

    public function __construct(
        protected readonly GroupService $groupService,
        protected readonly CourseService $courService,
        protected readonly UserService $userService
    ) {}



    public function dashboard()
    {

        return view('admin.dashboard', [
            'groups' => $this->groupService->groups()->get(),
            'courses' => $this->courService->all()
        ]);
    }


    public function profile()
    {
        return view(
            'admin.profile',
            [
                "user" => Auth::user()
            ]
        );
    }

   public function changePassword(ChanngePasswordRequest $request)
   {
        $this->userService->changePassword($request->validated(), Auth::user());
        return redirect()->route('admin.dashboard');
   }
   public function changeImage(ChangeImageRequest $request)
   {
        $this->userService->changeImage($request->validated(), Auth::user());
        return redirect()->route('admin.dashboard');
   }
   public function changeLanguage(Request $request)
   {
        $data = $request->validate([
                'lang' => ['required', 'string']
            ]);
        $this->userService->changeLanguage($data, Auth::user());
        return redirect()->route('admin.dashboard');
   }
}
