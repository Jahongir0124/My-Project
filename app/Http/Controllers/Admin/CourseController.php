<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CourseService;

class CourseController extends Controller
{


    public function __construct(protected readonly CourseService $courseservice )
    {
        
    }
    public function courses()
    {
        $courses = $this->courseservice->all();
        return view('admin.courses', ['courses' => $courses]);
        
    }
}
