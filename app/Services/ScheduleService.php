<?php


namespace app\Services;

use App\Repositories\DayRepository;
use App\Repositories\GroupRepository;
use App\Repositories\PairRepository;
use App\Repositories\ScheduleRepository;
use Illuminate\Support\Arr;




class ScheduleService
{
    public function __construct(
        protected readonly ScheduleRepository $scheduleRepository,
        protected readonly DayRepository $dayRepository,
        protected readonly PairRepository $pairRepository,
        protected readonly GroupRepository $groupRepository
        ){}


    public function schedules()
    {
        return $this->scheduleRepository->schedules();
    }

    public function getScheduleByGroup(int $group_id, int $semester_id = null)
    {
        $group_semester = $this->groupRepository->getGroupSemesterWithSemester($group_id, $semester_id);
        if ($semester_id)
            {
                return $this->scheduleRepository->getSchedulesByGroup($group_id)->where('semester_id', $semester_id);  
            }
        return $this->scheduleRepository->getScheduleByGroupSemester($group_semester);
    }

    public function getSchedulewithGroupSemester($group_id, $semester_id)
    {
        $group_semester = $this->groupRepository->getGroupSemesterWithSemester($group_id, $semester_id);
        return $this->scheduleRepository->getScheduleByGroupSemester($group_semester?->id);
    }

    public function days()
    {
        return $this->scheduleRepository->days();
    }

    public function store(array $data)
    {
        return $this->scheduleRepository->store($data);
    }

    public function update(array $data)
    {   
        $id = $data['id'];
        $data = Arr::except($data, ['id']);
        return $this->scheduleRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->scheduleRepository->destroy($id);
    }

    public function getByTeacher(int $teacher_id)
    {
        
    }
    public function getScheduleByGroupSemester(?int $group_semester_id)
    {
        $shift_id = $this->groupRepository->findByIdGroupSemester($group_semester_id)->shift_id;
        $pairs = $this->pairRepository->getByShift($shift_id);
        $schedules = $this->scheduleRepository->getScheduleByGroupSemester($group_semester_id);
        $scheduleMap = [];
        foreach($schedules as $schedule)
            {
                $scheduleMap[$schedule->pair_id][$schedule->day_id] = $schedule;
            }
        return [
            'schedulesMap' => $scheduleMap,
            'pairs' => $pairs
            ];
    }

    



    

   

}