<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    

    protected $fillable = ['name', 'course_id', 'deadline', 'score', 'file', 'file_name'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function task_answer()
    {
        return $this->hasOne(TaskAnswer::class);
    }
}
