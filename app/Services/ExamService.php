<?php



namespace app\Services;

use App\Repositories\ExamAttempRepository;
use App\Repositories\ExamRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;

class ExamService
{
    public function __construct(
        protected readonly ExamRepository $examRepository,
        protected readonly QuestionRepository $questionRepository,
        protected readonly ExamAttempRepository $examAttempRepository
        
        ){}
    
    public function exams()
    {

    }

    public function store(array $data)
    {
        return $this->examRepository->store($data);
    }


    public function examByTeacher()
    {
        $teacher_id = Auth::user()->teacher->id;
        return $this->examRepository->examByTeacher($teacher_id);
    }

    public function edit(array $data)
    {
        return $this->examRepository->edit($data);
    }

    public function destroy($exam)
    {
        return $exam->delete();
    }

    public function examsByGroup(int $group_id)
    {
        return $this->examRepository->examsByGroup($group_id);
    }


    public function beginExam($exam)
    {
        $questions = [];
        $ques = $exam->questions()->inRandomOrder()
        ->limit($exam->count_question)->get();

        foreach($ques as $q)
            {
                $q->setRelation(
                    'answers',
                    $q->answers->shuffle()
                );
            }

        return $ques;
    }
    
    public function checkExam($request)
    {
        $score = 0;
        foreach($request->answers as $question_id => $answered)
            {
                if($answered['answered'])
                    {
                        $question = $this->questionRepository->findById($answered['question_id']);
                        $answer = $question->answers()->find($answered['answered']);
                        if($answer->is_correct)
                            {
                                $score += 1;
                            }
                    }
            }
        
        $exam = $this->examRepository->findById($request->exam_id);

        $result = ($exam->score/$exam->count_question)*$score;
        $attempt = $this->examAttempRepository->update([
            'id' => $request->attempt,
            'score' => $result,
            'correct_count' => $score
        ]);

        return $attempt;


    }


    public function examsByStudent()
    {
        return $this->examRepository->examsByStudent(Auth::user()->student->id);
    }
}

