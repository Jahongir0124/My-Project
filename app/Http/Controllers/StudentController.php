<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;

class StudentController extends Controller
{
    
     public function __construct(private StudentService $service) {}



    
    public function dashboard()
    {   

        $student = $this->service->getStudent(1);
        return view('student-views.dashboard', ['student' => $student]);
    }
}
