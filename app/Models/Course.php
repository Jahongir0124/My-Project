<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
    protected $fillable = ['name', 'description', 'score_course', 'departament_id'];

  

    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }

   

}
