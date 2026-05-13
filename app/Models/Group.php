<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Group extends Model
{
    protected $fillable = ['name', 'departament_id', 'semester_id'];


    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }

}
