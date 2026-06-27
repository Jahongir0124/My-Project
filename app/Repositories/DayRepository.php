<?php


namespace app\Repositories;

use App\Models\Day;


class DayRepository
{
    public function days()
    {
        return Day::all();
    }
}