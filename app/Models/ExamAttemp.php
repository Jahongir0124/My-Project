<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAttemp extends Model
{

    protected $fillable = ['exam_id', 'student_id', 'started_at', 'finished_at', 'score'];


    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
