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

    
}