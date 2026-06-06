<?php


namespace app\Services;
use App\Repositories\ScheduleRepository;
use Illuminate\Support\Arr;




class ScheduleService
{
    public function __construct(protected readonly ScheduleRepository $scheduleRepository){}


    public function schedules()
    {
        return $this->scheduleRepository->schedules();
    }

    public function getScheduleByGroup(int $group_id, int $semester_id = null)
    {
        if ($semester_id)
            {
                return $this->scheduleRepository->getSchedulesByGroup($group_id)->where('semester_id', $semester_id);  
            }
        return $this->scheduleRepository->getSchedulesByGroup($group_id);
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



    

   

}