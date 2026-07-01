<?php


namespace app\Repositories;

use App\Models\Answer;

class AnswerRepository
{
    public function store($data)
    {
        return Answer::insert($data);
    }
}