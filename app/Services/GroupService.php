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
}