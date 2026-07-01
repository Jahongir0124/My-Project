<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    protected $fillable = [
        'course_id',
        'name',
        'type',
        'time',
        'count_question',
        'date_of_exam',
        'score'
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function examAttempts()
    {
        return $this->hasMany(ExamAttemp::class);
    }
}
