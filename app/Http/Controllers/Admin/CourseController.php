<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\CourseRequest;
use App\Http\Requests\Admin\Course\CourseUpdateRequest;
use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Services\DepartamentService;
use App\Services\GroupService;
use App\Services\SemesterService;
use App\Services\TeacherService;

class CourseController extends Controller
{


    public function __construct(
        protected readonly CourseService $courseService,
        protected readonly DepartamentService $departamentService,
        protected readonly GroupService $groupService,
        protected readonly SemesterService $semesterService,
        protected readonly TeacherService $teacherService
        ){}

    
    public function index()
    {
        $courses = $this->courseService->all();
        return view('admin.courses', 
        [
            'courses' => $courses,
            'departaments' => $this->departamentService->all()]);  
    }
    public function create()
    {
        return view('admin.course-create', [
            "groups" => $this->groupService->groups()->get(),
            'semesters' => $this->semesterService->all(),
            'teachers' => $this->teacherService->all()
            ]);
    }
    public function store(CourseRequest $request)
    
    {
        
        $this->courseService->create($request->validated());
        return redirect()->route('admin.courses.index')->with('succses', "Created Succesfully");
    }


    public function filter(Request $request)
    {
        return view('admin.courses', [
            "courses" => $this->courseService->filter($request),
            "departaments" => $this->departamentService->all()
        ]);
    }


    public function update(CourseUpdateRequest $request)
    {
       
        $this->courseService->update($request->validated());
        return redirect()->back()->with('succes', 'Updated');
    }



    public function destroy(int $id)
    {
        $this->courseService->destroy($id);
        return redirect()->back()->with('succsess', 'Deleted');
    }
    




}
