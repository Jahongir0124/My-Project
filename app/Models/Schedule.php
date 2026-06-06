<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    

    protected $fillable = [
    'group_id', 'semester_id', 'teacher_id', 'course_id',
    'day', 'start_time', 'end_time' 
    ];


    const days = [
        'Dushanba',
        'Seshanba',
        'Chorshanba',
        'Payshanba',
        'Juma'
    ];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
