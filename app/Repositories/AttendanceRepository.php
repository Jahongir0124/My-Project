<?php


namespace app\Repositories;

use App\Models\Attendance;


class AttendanceRepository
{
    public function store($data)
    {
        return Attendance::insert($data);
    }
}