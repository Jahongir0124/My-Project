<?php


namespace app\Repositories;
use App\Models\Rating;


class RatingRepository
{
    


    public function store(array $data)
    {
        return Rating::create($data);
    }

    public function findById(int $id)
    {
        return Rating::findOrFail($id);
    }

    public function update(array $data)
    {
        $rating = Rating::findOrFail($data['id']);
        $rating->update($data);
        return $rating->fresh();
    }
}