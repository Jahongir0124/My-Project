<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
    protected $fillable = ['name', 'teacher_id', 'group_id', 'description', 'score_course'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

}
