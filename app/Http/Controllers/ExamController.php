<?php

namespace App\Http\Controllers;

use App\Http\Requests\Exam\ExamRequest;
use App\Http\Requests\Exam\ExamUpdateRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Services\ExampAttempService;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public function __construct(
        protected readonly ExamService $examService,
        protected readonly ExampAttempService $examAttempService


    ) {}

    public function exams() {}


    public function examByTeacher()
    {
        $courses = Auth::user()->teacher->courses;
        return view('teacher.exams', [
            'exams' => $this->examService->examByTeacher(),
            'courses' => $courses
        ]);
    }


    public function store(ExamRequest $request)
    {
        $this->examService->store($request->validated());
        return redirect()->back();
    }

    public function edit(ExamUpdateRequest $request)
    {
        $this->examService->edit($request->validated());
        return redirect()->back();
    }

    public function addQuestion(Exam $exam)
    {
        return view(
            'teacher.add-question',
            [
                'exam' => $exam
            ]
        );
    }

    public function destroy(Exam $exam)
    {
        $this->examService->destroy($exam);
        return redirect()->back();
    }

    public function getQuestions(Exam $exam)
    {

        return view('teacher.questions', [
            'questions' => $exam->questions()->latest()->paginate(10)
        ]);
    }

    public function beginExam(Exam $exam)
    {
        $attemptStudent = $exam->examAttempts()->where('student_id', Auth::user()->student->id)->first();

        if($attemptStudent)
            {
                return redirect()->back()->with(403);
            }
        $attempt = $this->examAttempService->store($exam->id, Auth::user()->student->id);
        return view(
            'student-views.exam-begin',
            [
                'questions' => $this->examService->beginExam($exam),
                'exam' => $exam,
                'attempt' => $attempt
            ]
        );
    }


    public function checkExam(Request $request)
    {
        $attempt = $this->examService->checkExam($request);
        return response()->json([
            'redirect' => route(
                'student.exam.result',
                ['attemp_id' => $attempt->id]
            )
        ]);
    }
}
