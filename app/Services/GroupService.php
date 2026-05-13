<?php



namespace app\Services;
use App\Repositories\GroupRepository;

class GroupService
{
    public function __construct(private GroupRepository $groupRepesitory ){}
    


    public function all()
    {
        return $this->groupRepesitory->all();
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
        return $this->groupRepesitory->update($data);
    }
}