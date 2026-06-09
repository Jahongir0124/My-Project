<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskAnswer\TaskAnswerRequest;
use App\Services\TaskAnswerService;


class TaskAnswerController extends Controller
{

    public function __construct(protected readonly TaskAnswerService $taskAnswerService){}


    public function store(TaskAnswerRequest $request)
    {
        $this->taskAnswerService->store($request->validated());
        return redirect()->back()->with('success', 'Cretaed');
    }   


    public function update(Request $request)
    {
       
        $data = $request->validate([
            "id" => "required|integer|exists:task_answers,id",
            "file_answer" => "required|file|mimes:pdf,docx,zip,pptx,xlsx,rar|max:10240"
        ]);
        $this->taskAnswerService->update($data);
        return redirect()->back()->with('success', 'Updated');
    }
}
