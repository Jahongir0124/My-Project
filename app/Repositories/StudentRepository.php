<?php


namespace App\Repositories;

use App\Models\User;



class StudentRepository {


    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function allStudent()
    {
        
    }
}

