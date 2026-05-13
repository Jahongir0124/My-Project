<?php



namespace app\Repositories;

use App\Models\Teacher;



class TeacherRepository
{

    public function all()
    {
        return Teacher::latest()->get();
    }

}