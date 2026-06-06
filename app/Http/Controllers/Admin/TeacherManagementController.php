<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Teacher\StoreTeacherRequest;
use App\Http\Requests\Admin\Teacher\TeacherRequest;
use App\Http\Requests\UserRequest;
use App\Services\DepartamentService;
use App\Services\TeacherService;
use Illuminate\Http\Request;




class TeacherManagementController extends Controller
{
        public function __construct(
            protected readonly TeacherService $teacherService,
            protected readonly DepartamentService $departamnetService

           
        ){}
        public function index(Request $requets)
        {

            $teachers = $this->teacherService->filter($requets)->latest()->get();
            return view('admin.teachers', [
                'teachers' => $teachers,
                "departaments" => $this->departamnetService->all()
            ]);
        }


        public function store(StoreTeacherRequest $request)
        {   
            $this->teacherService->create($request->validated());
            return redirect()->back()->with('success', 'Created');
        }

        public function destroy(int $id)
        {
            $this->teacherService->destroy($id);
            return redirect()->back()->with('success', 'Deleted');
        }
        public function update(TeacherRequest $request)
        {
            
            $this->teacherService->update($request->validated());
            return redirect()->back()->with('success', 'Updated!');
        }
        


       
}
