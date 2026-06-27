<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Semester\SemesterRequest;
use App\Http\Requests\Admin\Semester\SemesterUpdateRequest;
use Illuminate\Http\Request;
use App\Services\SemesterService;

class SemestrController extends Controller
{
    
  public function __construct(protected readonly SemesterService $semesterService){}
  
  
  public function index()
  {

    return view('admin.semester', [
      "semesters" => $this->semesterService->all()
    ]);
  }


  public function create(SemesterRequest $request)
  {
      $this->semesterService->create($request->validated());
      return redirect()->back()->with('succses', 'Created Succsesfully');
  }

  public function update(SemesterUpdateRequest $requets)
  {
      $this->semesterService->update($requets->validated());
      return redirect()->back()->with('succses', 'Updated Succesfully!');
  }


  public function destroy(int $id)
  {

    $this->semesterService->destroy($id);
    return redirect()->back()->with('succses', 'Deleted');
    
  }

  public function json()
  {
    return response()->json($this->semesterService->all());
  }

  public function usedSemester(Request $request)
  {
      return response()->json($this->semesterService->getUsedSemesterGroup($request->groupId));
  }
  
}
