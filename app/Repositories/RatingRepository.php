<?php


namespace app\Repositories;
use App\Models\Rating;


class RatingRepository
{
    


    public function store(array $data)
    {
        return Rating::create($data);
    }
}