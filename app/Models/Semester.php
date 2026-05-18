<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Semester extends Model
{

    protected $fillable = ['name', 'start_date', 'end_date'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    
}
