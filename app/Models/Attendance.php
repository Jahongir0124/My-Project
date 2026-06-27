<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    
    protected $fillable = ['student_id', 'course_id', 'day', 'theme', 'status'];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
