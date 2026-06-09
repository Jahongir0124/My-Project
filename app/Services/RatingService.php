<?php


namespace app\Services;

use App\Repositories\RatingRepository;

class RatingService
{
    public function __construct(protected readonly RatingRepository $ratingRepository){}


    public function ratingTask($task)
    {
        $students = $task->schedule->group->students;
        dd($students);
    }
    public function store()
    {

    }
}