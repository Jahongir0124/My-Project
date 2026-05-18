<?php 



namespace app\Repositories;

use App\Models\Departament;


class DepartamentRepository
{

    public function all()
    {
        return Departament::latest()->get();
    }

    public function create(string $name)
    {   
        
        return Departament::create([
            "name" => $name
        ]);
    }

    

    public function getByFilter($data)
    {
        $query = Departament::query();
        if ($data->name)
            {
                $query->where('name', 'like', '%' . $data->name . '%');
            }

        if ($data->created_at == 'latest')
            {
                $query->orderBy('created_at', 'desc');
            }

        if ($data->cretaed_at == 'oldest')
            {
                $query->orderBy('created_at', 'asc');
            }

        return $query->get();
    }


    public function update(array $data)
    {

        $departament = Departament::findOrFail($data['id']);
        $departament->update([
            "name" => $data['name']
        ]);
        return $departament->fresh();
    }


    public function destroy(int $id)
    {
        $departament = Departament::findOrFail($id);
        return $departament->delete();
    }
}