<?php

namespace App\Http\Controllers;

use App\Services\ExamService;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    
    public function __construct(protected readonly ExamService $examService){}

    public function exams()
    {
        
    }



}
