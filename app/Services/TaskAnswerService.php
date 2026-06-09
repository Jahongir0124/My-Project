<?php



namespace app\Services;

use App\Repositories\TaskAnswerRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class TaskAnswerService
{
    public function __construct(protected readonly TaskAnswerRepository $taskAnswerRepository){}


    public function store(array $data)
    { 
        $data['student_id'] = Auth::user()->student->id;
        $name = $data['file_answer']->getClientOriginalName();
        $data['file_name'] = $name;
        $data['file_answer'] = $data['file_answer']->store('taskAnswers', 'public');
        return $this->taskAnswerRepository->store($data);
    }

    public function update(array $data)
    {
        $id = $data['id'];
        $taskAnswer = $this->taskAnswerRepository->findById($id);

        if (!empty($taskAnswer->file_answer))
            {
                Storage::disk('public')->delete($taskAnswer->file_answer);
            }
        $name = $data['file_answer']->getClientOriginalName();
        $data['file_name'] = $name;
        $data['file_answer'] = $data['file_answer']->store('taskAnswers', 'public');
        $data = Arr::except($data, ['id']);
        return $this->taskAnswerRepository->update($id, $data);
    }
}