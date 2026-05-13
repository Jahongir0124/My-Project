<?php



namespace app\Repositories;



use App\Models\Semester;

class SemesterRepository
{
    
    public function all()
    {
        return Semester::latest()->get();
    }
}