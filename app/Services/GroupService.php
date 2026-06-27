<?php



namespace app\Services;
use App\Repositories\GroupRepository;

class GroupService
{
    public function __construct(private GroupRepository $groupRepesitory ){}
    


    public function groups()
    {
        return $this->groupRepesitory->groups();
    }

    public function create(array $data)
    {
        return $this->groupRepesitory->create($data);
    }

    public function destroy(int $id)
    {
        return $this->groupRepesitory->destroy($id);
    }

    public function update(array $data)
    {   
        $id = $data['id'];
        unset($data['id']);
        return $this->groupRepesitory->update($id, $data);
    }

    public function getByFilter($data)
    {
        return $this->groupRepesitory->getByFilter($data);
    }

    public function getGroupById(int $id)
    {
        return $this->groupRepesitory->getGroupById($id);
    }

    public function createSemesterGroup($data)
    {
      
        $group_semester = $data->validate([
            "group_id" => "required|integer|exists:groups,id",
            "semester_id" => "required|integer|exists:semesters,id",
            "shift_id" => "required|integer|exists:shifts,id"
        ]);

        return $this->groupRepesitory->createSemesterGroup($group_semester);
    }

    public function getGroupSemester(int $group_id)
    {
        return $this->groupRepesitory->getGroupSemester($group_id);
    }

    public function getGroupSemesterWithSemester(int $group_id, $semester_id)
    {
        return $this->groupRepesitory->getGroupSemesterWithSemester($group_id, $semester_id);
    }

    public function getAllGroupSemesters()
    {
        return $this->groupRepesitory->getAllGroupSemesters();
    }

    public function findByIdGroupSemester(int $id)
    {
        return $this->groupRepesitory->findByIdGroupSemester($id);
    }
}