<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Http\Requests\Admin\Group\GroupRequest;
use App\Http\Requests\Admin\Group\UpdateGroupRequest;
use App\Models\Group;
use App\Services\CourseService;

class AdminController extends Controller
{
        
        public function __construct(
                protected readonly GroupService $groupService,
                protected readonly CourseService $courService
        ){}
        


        public function dashboard()
        {   
            
            return view('admin.dashboard', [
                'groups' => $this->groupService->groups()->get(),
                'courses' => $this->courService->all()
            ]);
        }


        

}
