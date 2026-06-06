<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    

    protected $fillable = ['name', 'schedule_id', 'deadline', 'score', 'file', 'file_name'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
