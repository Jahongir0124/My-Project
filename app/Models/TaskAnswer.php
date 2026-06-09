<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskAnswer extends Model
{
    
    protected $fillable = ['task_id', 'student_id', 'file_name', 'file_answer'];


    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
