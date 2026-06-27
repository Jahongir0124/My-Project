<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    
    protected $fillable = ['name'];

    public function pairs()
    {
        return $this->hasMany(Pair::class);
    }

    public function group_semesters()
    {
        return $this->hasMany(GroupSemester::class);
    }
}
