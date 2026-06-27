<?php

namespace app\Services;

use App\Repositories\AttendanceRepository;
use Exception;

class AttendanceService
{
    public function __construct(protected readonly AttendanceRepository $attandanceRepository)
    {}


    public function store($data)
    {
        $dataInsert = [];
        try {

            foreach($data['students'] as $student)
                {
                    array_push($dataInsert, [
                        "course_id" => $data['course_id'],
                        "student_id" => $student,
                        "day" => $data['day'],
                        "theme" => $data['theme']
                    ]);
                }
            return $this->attandanceRepository->store($dataInsert);
        }
        catch (Exception $e)
        {
            array_push($data, [
                "course_id" => $data['course_id'],
                "day" => $data['day'],
                "theme" => $data['theme']
            ]);
            return $this->attandanceRepository->store($dataInsert);
        }
            
    }
}

