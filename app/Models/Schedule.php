<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    

    protected $fillable = [
    'group_semester_id', 'course_id',
    'day_id', 'pair_id'
    ];


    const days = [
        'Dushanba',
        'Seshanba',
        'Chorshanba',
        'Payshanba',
        'Juma'
    ];


   

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
    public function pair()
    {
        return $this->belongsTo(Pair::class);
    }
   

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
