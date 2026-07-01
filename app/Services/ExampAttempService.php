<?php


namespace app\Services;

use App\Repositories\ExamAttempRepository;



class ExampAttempService
{
    public function __construct(protected readonly ExamAttempRepository $examAttempRepository) {}


    public function store(int $exam_id, int $student_id)
    {
        return $this->examAttempRepository->store([
            'exam_id' => $exam_id,
            'student_id' => $student_id,
            'started_at' => now()
        ]);
    }

    public function findById(int $id)
    {
        return $this->examAttempRepository->findById($id);
    }


    public function getInfo(int $id)
    {
        $attempt = $this->examAttempRepository->findById($id);
        $exam = $attempt->exam;
        $course = $exam->course->name;
        $exam_name = $exam->name;
        $count_question = $exam->count_question;
        $count_correct = $attempt->score;
        $count_incorrect = $count_question - $count_correct;
        $procent = ($count_correct/$count_question)*100;
        $score = ($exam->score/$count_question)*$count_correct;

        return [
            'course_name' => $course,
            'exam_name' => $exam_name,
            'count' => $count_question,
            'correct' => $count_correct,
            'wrong' => $count_incorrect,
            'procent' => $procent,
            'score' => $score
        ];

    }

    public function getByExamStudent(int $exam_id)
    {
        return $this->examAttempRepository->getByExamStudent($exam_id);
    }
}
