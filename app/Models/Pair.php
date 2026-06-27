<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    
    protected $fillable = ['shift_id', 'start_time', 'end_time'];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
}
