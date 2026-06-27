<?php


namespace app\Repositories;

use App\Models\Shift;

class ShiftRepository
{
    
    public function index()
    {
        return Shift::latest()->get();
    }

    public function store(array $data)
    {
        return Shift::create($data);
    }

    public function destroy($shift)
    {
        return $shift->delete();
    }

    public function findById(int $id)
    {
        return Shift::findOrFail($id);
    }
}