<?php

namespace App\Http\Controllers;

use App\Models\ExamAttemp;
use App\Services\ExampAttempService;
use Illuminate\Http\Request;

class ExamAttempController extends Controller
{
    

    public function __construct(protected readonly ExampAttempService $examAttemptService)
    {}
    public function resultExam(int $attemp_id)
    {
        $examAttempt = $this->examAttemptService->getInfo($attemp_id);
        return view('student-views.result', $examAttempt);
    }
}
