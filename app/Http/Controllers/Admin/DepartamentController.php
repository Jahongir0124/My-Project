<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\CourseRequest;
use Illuminate\Http\Request;
use App\Services\DepartamentService;
use App\Http\Requests\Admin\Departament\DepartamentRequest;
use App\Http\Requests\Admin\Departament\DepartamentUpdateRequest;



class DepartamentController extends Controller
{
    
    public function __construct(protected DepartamentService $departamentService){}


    public function index()
    {   

      
        return view('admin.departaments', [
            'departaments' => $this->departamentService->all()
        ]);
    }

    public function create(DepartamentRequest $request)
    {   
        
        $data = $request->validate([
            
            "name" => "required|string|max:255",
            "courses" => "nullable|array"
        ]);
        
        $this->departamentService->create($data);
        return response()->json([
        'message' => 'Created successfully'
            ]);
    }


    public function filter(Request $request)
    {
        
        $departaments = ($this->departamentService->getByFilter($request));

        return view('admin.departaments', [
            'departaments' => $departaments
        ]);

    }

    public function update(DepartamentUpdateRequest $request)
    {

        $this->departamentService->update($request->validated());
        return redirect()->back()->with('succses', 'Updated Succesfull');

    }


    public function destroy(int $id)
    {
        $this->departamentService->destroy($id);
        return redirect()->back()->with('succses', 'Deleted Succesfully');
    }

    public function json()
    {
        return response()->json($this->departamentService->all());
    }
   
}
