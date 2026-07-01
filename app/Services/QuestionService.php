<?php



namespace app\Services;

use App\Repositories\AnswerRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;


class QuestionService
{
    public function __construct(
        protected readonly QuestionRepository $questionRepository,
        protected readonly AnswerRepository $answerRepository
    ) {}


    public function findById(int $id)
    {
        return $this->questionRepository->findById($id);
    }
    public function createInsertData(int $question_id, $options)
    {
        $insertData = [];
        foreach ($options as $option) {
            array_push(
                $insertData,
                [
                    'question_id' => $question_id,
                    'answer' => $option['answer'],
                    'is_correct' => $option['is_correct']

                ]
            );
        }
        return $insertData;
    }
    public function store($request)
    {
        $title = $request->title;
        $exam_id = $request->exam_id;
        $options = $request->options;
        return DB::transaction(function () use ($title, $exam_id, $options) {
            $questionCreated = $this->questionRepository->store($exam_id, $title);
            $this->answerRepository->store($this->createInsertData($questionCreated->id, $options));
            return $questionCreated;
        });
    }

    public function getByName($name)
    {
        return $this->questionRepository->getByName($name);
    }
    public function import($request)
    {
        $request->validate([
            'exam_id' => 'required|integer|exists:exams,id',
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        $exam_id = $request->exam_id;
        $questionsInsert = [];
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        $headers = array_shift($rows);



        $insertData = [];
        foreach ($rows as $r) {

            $row = array_combine($headers, $r);

            array_push($questionsInsert, [
                'title' => $row['question'],
                'exam_id' => $exam_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $this->questionRepository->insertData($questionsInsert);
        $answersInsert = [];
        $anwersData = [];
      
        foreach ($rows as $row) {
            $row = array_combine($headers, $row);
   
            $question_id = $this->questionRepository->getByName($row['question'])->id;
            $correct = $row['correct'];
            $row = Arr::only($row, ['A', 'B', 'C', 'D']);
            
            foreach ($row as $k => $r) {
       
                if ($correct == $k) {
                    array_push($anwersData, [
                        'question_id' => $question_id,
                        'answer' => $r,
                        'is_correct' => true
                    ]);
                }
                else{
                    array_push($anwersData, [
                        'question_id' => $question_id,
                        'answer' => $r,
                        'is_correct' => false
                    ]);
                }
                
            
            }
        }
        $this->answerRepository->store($anwersData);
        return true;
    }
}
