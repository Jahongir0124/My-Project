<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\ScheduleRequest;
use App\Http\Requests\Admin\Schedule\ScheduleUpdateRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\ScheduleService;
use App\Services\SemesterService;
use App\Services\TeacherService;
use App\Services\CourseService;


class ScheduleController extends Controller
{
    

    public function __construct(
        
    protected readonly GroupService $groupService,
    protected readonly ScheduleService $scheduleService,
    protected readonly SemesterService $semesterService,
    protected readonly TeacherService $teacherService,
    protected readonly CourseService $courseService
    ){}
    public function index()
    {

        return view('admin.schedule', ['groups' => $this->groupService->groups()->latest()->get()]);
    }


    public function schedulesByGroup(int $group_id, int $semester_id = null)
    {

        $select = null;
        if ($semester_id)
            {
                $select = $this->semesterService->getSemesterById($semester_id);
            }
        $departament_id = $this->groupService->getGroupById($group_id)->departament->id;
        return view('admin.schedule-group', [
            'schedules' => $this->scheduleService->getScheduleByGroup($group_id, $semester_id)->get(),
            'group' => $this->groupService->getGroupById($group_id),
            'select' => $select,
            'groups' => $this->groupService->groups()->get(),
            'semesters' => $this->semesterService->all(),
            'teachers' => $this->teacherService->getTeacherByDepartament($departament_id),
            'days' => $this->scheduleService->days(),
            'courses' => $this->courseService->getCourseByDepartament($departament_id)
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
