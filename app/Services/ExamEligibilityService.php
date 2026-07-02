<?php




namespace app\Services;

use App\Models\Exam;
use App\Models\User;




class ExamEligibilityService
{
    public function canTakeExam(
        User $stduent,
        Exam $exam
    ): bool {
        $course = $exam->course;

        $score = $stdeunt->task_answers()->where('course_id')
    }
}