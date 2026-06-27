<?php 


namespace app\Repositories;

use App\Models\Schedule;
use Illuminate\Support\Facades\Schedule as FacadesSchedule;

class ScheduleRepository
{
    public function schedules()
    {

        return Schedule::latest()->get();
    }


    public function getSchedulesByGroup(int $group_id)
    {
        $query = Schedule::where('group_id', $group_id);
        return $query;
    }

    public function getScheduleById($id)
    {
        return Schedule::findOrFail($id);
    }

    public function days()
    {
        return Schedule::days;
    }

    public function store(array $data)
    {
        $schedule = Schedule::create($data);

        return $schedule;
    }

    public function update(int $id, array $data)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($data);
        return $schedule->fresh();
    }

    public function destroy(int $id)
    {
        $schedule = Schedule::findOrFail($id);
        return $schedule->delete();
    }

    public function findById(int $id)
    {
        return Schedule::findOrFail($id);
    }


    public function createdSchedule(int $gr_semester_id, $day_id)
    {
        return Schedule::where('group_semester_id', $gr_semester_id)
        ->where('day_id', $day_id)->pluck('pair_id');
    }

    public function getScheduleByGroupSemester($group_semester_id)
    {
        return Schedule::with(
            'day',
            'pair',
            'course',
            'teacher'
        )->where('group_semester_id', $group_semester_id)->get();
    }

    
}