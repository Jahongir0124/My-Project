<?php



namespace app\Repositories;

use App\Models\Group;
use App\Models\GroupSemester;
use Exception;

class GroupRepository
{
    public function groups()
    {
        return Group::query();
    }

    public function findById(int $id)
    {
        return Group::findOrFail($id);
    }

    public function create(array $data)
    {   
        $group = Group::create($data);
        return $group;
    }
    public function destroy(int $id): bool
    {
        $group = Group::findOrFail($id);
        return $group->delete();
    }
    public function update(int $id, array $data)
    {    
        $group = Group::findOrFail($id);
        $group->update($data);
        return $group->fresh();
    }
    public function getByFilter($data)
    {
        $query = Group::query();

        if ($data->name){

            $query->where('name', 'like', '%' . $data->name . '%');
        }
        if ($data->departament_id)
            {
                $query->where('departament_id', $data->departament_id);
            }
        if ($data->semester_id)
            {
                $query->where('semester_id', $data->semester_id);
            }
        if ($data->created_at)
            {
                if ($data->created_at == 'latest')
                    {
                        $query->orderBy('created_at', 'desc');
                    }

                else 
                    {
                        $query->orderBy('created_at', 'asc');
                    }
            }
        return $query->paginate(10);  
    }
    public function getIdByName(string $name)
    {
        return Group::where('name', $name)->first()->id;  
    }

    public function getGroupById(int $id)
    {
        return Group::findOrFail($id);
    }

    public function getGroupSemester(int $group_id)
    {
        return GroupSemester::where('group_id', $group_id)->get();
    }

    public function createSemesterGroup($data)
    {
        return GroupSemester::create($data);
    }

    public function getGroupSemesterWithSemester(int $group_id, $semester_id)
    {
        return GroupSemester::where('group_id', $group_id)->where('semester_id', $semester_id)->first();
    }

    public function findByIdGroupSemester(?int $id)
    {
        return GroupSemester::findOrFail($id);
    }

    public function getAllGroupSemesters()
    {
        return GroupSemester::latest()->get();
    }

    public function getExams($group_id)
    {
        $exams = Group::where('group_id', $group_id)->with([
            'courses.exam'
        ])->get();

        return $exams;
    }
}