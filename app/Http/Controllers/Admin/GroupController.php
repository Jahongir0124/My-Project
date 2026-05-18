<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\DepartamentService;
use App\Http\Requests\Admin\Group\GroupRequest;
use App\Http\Requests\Admin\Group\UpdateGroupRequest;
use App\Services\SemesterService;



class GroupController extends Controller
{
     public function __construct(
            protected readonly  GroupService $groupService,
            protected readonly DepartamentService $departamentService,
            protected readonly SemesterService $semestrService
            ){}
       

        public function index()
        {   
            return view('admin.groups', [
                'groups' => $this->groupService->all(),
                'departaments' => $this->departamentService->all(),
                'semestrs' => $this->semestrService->all()
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


        public function updateGroup(UpdateGroupRequest $request, Group $group)
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

}
