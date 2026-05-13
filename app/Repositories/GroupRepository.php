<?php



namespace app\Repositories;

use App\Models\Group;
use Exception;

class GroupRepository
{
    public function all()
    {
        return Group::latest()->paginate(5);
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

    public function update(array $data)
    {
        
        $group = Group::findOrFail($data['id']);
        $group->group_number = $data['group_number'];
        $group->save();
        return $group;
    }

    
}