<?php


namespace app\Services;

use App\Repositories\GroupRepository;
use App\Repositories\PairRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\ShiftRepository;
use Illuminate\Support\Facades\DB;

class ShiftService
{
    public function __construct(
        protected readonly ShiftRepository $shiftRepository,
        protected readonly PairRepository $pairRepository,
        protected readonly ScheduleRepository $scheduleRepository,
        protected readonly GroupRepository $groupRepository
        ){}

    public function index()
    {
        return $this->shiftRepository->index();
    }

    public function store($data)
    {
        $shift = $data->validate([
            'name' => 'required|string|max:255'
        ]);
        $pairs = $data['pairs'];
        if(!empty($pairs))
            {
                return DB::transaction(function () use ($shift, $pairs) {
                    $shiftCreated = $this->shiftRepository->store($shift);
                    $this->pairRepository->store($shiftCreated->id, $pairs);
                    return $shiftCreated;
                });
            }

        return $this->shiftRepository->store($shift);
    }

    public function destroy($shift)
    {
        return $this->shiftRepository->destroy($shift);
    }

    public function findById(int $id)
    {
        return $this->shiftRepository->findById($id);
    }

    public function usedShifts($data)
    {
        $shift_id = $this->groupRepository->findByIdGroupSemester($data['group_semester_id'])->shift_id;
        $usedIds = $this->scheduleRepository->createdSchedule($data['group_semester_id'], $data['day_id']);
        return $this->pairRepository->createdPairs($usedIds, $shift_id);
    }

    
}