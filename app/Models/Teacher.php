<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    
    protected $fillable = ['user_id', 'first_name', 'last_name', 'full_name', 'patnynomic', 'departament_id', 'specialization', 'phone'];


    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
