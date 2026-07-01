<?php


namespace app\Services;

use app\Repositories\CourseRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\TaskAnswerRepository;
use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;



class TaskService
{
    public function __construct(
        protected readonly TaskRepository $taskRepository,
        protected readonly ScheduleRepository $scheduleRepository,
        protected readonly TaskAnswerRepository $taskAnswerRepository,
        protected readonly CourseRepository $courseRepository
    ) {}



    public function getTasksBySubject(int $subject_id)
    {
        return $this->taskRepository->getTasksBySubject($subject_id);
    }

    public function checkScore(int $course_id)
    {
        $sum = 0;
        $course = $this->courseRepository->findById($course_id);
        foreach ($course->tasks as $task) {
            $sum += $task->score;
        }
        return ['score' => $course->score_course - $sum];
    }

    public function store($data)
    {
        $data['teacher_id'] = Auth::user()->teacher->id;
        try {
            $name = $data['file']->getClientOriginalName();
            $data['file_name'] = $name;
            $path = $data['file']->storeAs('tasks', $name, 'public');
        } catch (Exception $e) {
            $path = null;
        }

        $scoreMax = ($this->checkScore($data['course_id']))['score'];

        if ($scoreMax < $data['score'] || $data['score'] == 0) {
            throw ValidationException::withMessages([
                "score" => "Yangi vazifaga $scoreMax ball berish mumkin! vazifa ball 0 bo'lishi mumkin emas"
            ]);
        }
        return $this->taskRepository->store($data, $path);
    }


    public function update($request)
    {
        $data = $request->validate([
            "id" => "required|integer|exists:tasks,id",
            'name' => 'required|string',
            "deadline" => "required|date",
            "file" => "nullable|file|mimes:pdf,docx,xlsx,zip,rar,jpg,png",
            "score" => "nullable|integer"
        ]);

        if ($request->hasFile('file')) {
            $task = $this->taskRepository->findById($data['id']);
            if ($task->file) {
                Storage::delete($task->file);
            }
            $data['file_name'] = $data['file']->getClientOriginalName();
            $data['file'] = $data['file']->store('tasks', 'public');
        }
        return $this->taskRepository->update($data);
    }

    public function destroy($task)
    {

        if (!empty($task->file)) {
            Storage::disk('public')->delete($task->file);
        }
        return $this->taskRepository->destroy($task);
    }


    public function indicators(int $id)
    {

        $taskIds = $this->getTasksBySubject($id)->get()->pluck('id');
        $taskAnswers = $this->taskAnswerRepository->getByTaskStudent($taskIds)->get();
        $tasksScores = $this->taskRepository->getSumScoreOfTask($taskIds)->get();
        $totalScore = $tasksScores->sum('score');
        $total = $taskAnswers->sum('rating.score');
        $result = 0;
        if ($totalScore) {

            $result = round($total / $totalScore, 3) * 100;
        }
        $rating = 0;
        if (60 <= $result && $result < 70) {
            $rating = 3;
        } elseif (70 <= $result && $result < 90) {
            $rating = 4;
        } elseif (90 <= $result && $result <= 100) {
            $rating = 5;
        } else {
            $rating = 2;
        }
        return [
            "score" => $total,
            "max_score" => $totalScore,
            "procent" => $result,
            "rating" => $rating
        ];
    }
}
