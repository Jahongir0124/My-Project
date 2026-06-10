<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

    protected $fillable = ['first_name', 'last_name', 'group_id', 'user_id', 'patrnomic'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task_answers()
    {
        return $this->hasMany(TaskAnswer::class);
    }
}
