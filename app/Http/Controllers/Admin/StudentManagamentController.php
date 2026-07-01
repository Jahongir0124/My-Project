<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Services\DepartamentService;
use App\Services\GroupService;
use Spatie\SimpleExcel\SimpleExcelReader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Http\Requests\Admin\Student\StudentRequest;



class StudentManagamentController extends Controller
{
    public function __construct(
        protected readonly StudentService $studentService,
        protected readonly GroupService $groupService,
        protected readonly DepartamentService $departamentService
    ) {}



    public function index(Request $request)
    {
        $students = $this->studentService->filter($request)->latest()->paginate(10);

        return view('admin.students', [
            'students' => $students,
            'groups' => $this->groupService->groups()->get(),
            'departaments' => $this->departamentService->all()
        ]);
    }


    public function import(Request $request)
    {


        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());

        $sheet = $spreadsheet->getActiveSheet();

        $rows = $sheet->toArray();
        $headers = array_shift($rows);

        $this->studentService->import($rows, $headers);

        return redirect()->back()->with('success', 'Created');
    }


    public function store(StudentRequest $request)
    {
        $this->studentService->store($request->validated());
        return redirect()->back()->with('success', 'Created');
    }


    public function destroy(int $id)
    {
        $this->studentService->destroy($id);
        return redirect()->back()->with('success', 'Deleted');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            "id" => "required|integer|exists:students,id",
            "first_name" => "required|string",
            "last_name" => "required|string",
            "patrnomic" => "nullable|string"
        ]);

        $this->studentService->update($data);
        return redirect()->back()->with('success', 'Updated');
    }
}
