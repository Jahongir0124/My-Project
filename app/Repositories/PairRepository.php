<?php


namespace app\Repositories;

use App\Models\Pair;

class PairRepository
{
    public function store(int $shift_id, array $pairs)
    {   
        $data = [];
        foreach($pairs as $pair)
            {
               array_push($data, [
                'shift_id' => $shift_id,
                'start_time' => $pair['start'],
                'end_time' => $pair['end']
                ]);
            }
        Pair::insert($data);
        return true;
    }

    public function createdPairs($usedIds, $shift_id)
    {
        return Pair::whereNotIn('id', $usedIds)->where('shift_id', $shift_id)->get(['id', 'start_time', 'end_time']);
    }

    public function getByShift($id)
    {
        return Pair::where('shift_id', $id)->get();
    }
}