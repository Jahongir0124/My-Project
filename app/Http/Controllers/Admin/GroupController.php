<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\DepartamentService;
use App\Http\Requests\Admin\Group\GroupRequest;
use App\Http\Requests\Admin\Group\UpdateGroupRequest;
use App\Services\SemesterService;
use App\Services\ShiftService;

class GroupController extends Controller
{
     public function __construct(
            protected readonly  GroupService $groupService,
            protected readonly DepartamentService $departamentService,
            protected readonly SemesterService $semestrService,
            protected readonly ShiftService $shiftService
            ){}
       

        public function index()
        {   
            return view('admin.groups', [
                'groups' => $this->groupService->groups()->latest()->paginate(10),
                'departaments' => $this->departamentService->all(),
                'semestrs' => $this->semestrService->all(),
                "shifts" => $this->shiftService->index()
                
            ]);
        }

        public function create()
        {
            return view('admin.add-group',
            [
                'departaments' => $this->departamentService->all(),
                'semestrs' => $this->semestrService->all()
            ]);
        }

        public function store(GroupRequest $request)
        {   
            
            $this->groupService->create($request->validated());
            return redirect()->route('admin.group.index'); 
        }

        public function destroy(Request $request)
        {
            
            $id = $request->id;
            $this->groupService->destroy($id);
            return redirect()->route('admin.group.index');

        }


        public function update(UpdateGroupRequest $request)
        {
            
            $this->groupService->update($request->validated());
            return redirect()->back();

        }
        public function filter(Request $request)
        {
           

            return view('admin.groups', [
                'groups' =>  $this->groupService->getByFilter($request),
                'departaments' => $this->departamentService->all(),
                'semestrs' => $this->semestrService->all()
            ]);
        }

        public function json()
        {
            return response()->json($this->groupService->groups()->get(['id', 'name']));
        }

        public function createGroupSemester(Request $request)
        {
            $this->groupService->createSemesterGroup($request);
            return redirect()->back()->with('success', 'Created');
        }

        

}
