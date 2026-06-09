<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    
    protected $fillable = ['task_answer_id', 'teacher_id', 'score', 'comment'];

    public function taskAnswer()
    {
        return $this->belongsTo(TaskAnswer::class);
    }
}
