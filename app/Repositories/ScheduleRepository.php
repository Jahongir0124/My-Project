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

    
}