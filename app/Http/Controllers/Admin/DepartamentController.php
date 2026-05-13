<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DepartamentService;
use App\Http\Requests\Admin\Departament\DepartamentRequest;

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
       
        $this->departamentService->create($request->validated());
        return redirect()->back()->with('succes', 'Departament created!');
    }


    public function filter(Request $request)
    {
        
        $departaments = ($this->departamentService->getByFilter($request));

        return view('admin.departaments', [
            'departaments' => $departaments
        ]);

    }
}
