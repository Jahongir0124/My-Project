<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;


class QuestionController extends Controller
{
    public function __construct(protected readonly QuestionService $questionService) {} 
    
    
    public function store(Request $request)
    {
        $this->questionService->store($request);
        return response()->json(['msg' => 'Ok']);
    } 
    
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->back();
    }

    public function import(Request $request)
    {
        $this->questionService->import($request);
        return redirect()->back()->with('success', 'Created');
    }

}
