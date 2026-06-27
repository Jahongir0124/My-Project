<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupSemester extends Model
{
    
    protected $fillable = ['group_id', 'semester_id', 'shift_id'];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
