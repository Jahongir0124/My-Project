<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\ScheduleRequest;
use App\Http\Requests\Admin\Schedule\ScheduleUpdateRequest;
use App\Models\Group;
use App\Models\GroupSemester;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\ScheduleService;
use App\Services\SemesterService;
use App\Services\TeacherService;
use App\Services\CourseService;
use App\Services\DayService;

class ScheduleController extends Controller
{
    

    public function __construct(
        
        protected readonly GroupService $groupService,
        protected readonly ScheduleService $scheduleService,
        protected readonly SemesterService $semesterService,
        protected readonly TeacherService $teacherService,
        protected readonly CourseService $courseService,
        protected readonly DayService $dayService
    ){}
    public function index()
    {

        return view('admin.schedule', ['group_semesters' => $this->groupService->getAllGroupSemesters()]);
    }


    public function scheduleGroupSemester(int $group_semester_id)
    {
        
        $group_semester = $this->groupService->findByIdGroupSemester($group_semester_id);
        $departamant_id = $group_semester->group->departament_id;
        return view('admin.schedule-group', [
            "schedules" => $this->scheduleService->getScheduleByGroupSemester($group_semester->id)['schedulesMap'] ?? [],
            'pairs' => $this->scheduleService->getScheduleByGroupSemester($group_semester->id)['pairs'] ?? [],
            
            'days' => $this->dayService->days(),
            'group_semester' => $group_semester
        ]);
    }


    public function store(ScheduleRequest $request)
    {   
        $this->scheduleService->store($request->validated());
        return redirect()->back()->with('success', 'Created');
    }
    public function update(ScheduleUpdateRequest $request)
    {
        $this->scheduleService->update($request->validated());
        return redirect()->back()->with('success', 'Updated');
    }
    public function jsonDay()
    {
        return response()->json($this->scheduleService->days());
    }
    public function destroy(int $id)
    {
        $this->scheduleService->destroy($id);
        return redirect()->back()->with('success', 'Deleted');
    }


   
}
