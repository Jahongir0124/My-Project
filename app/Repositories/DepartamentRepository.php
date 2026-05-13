<?php 



namespace app\Repositories;

use App\Models\Departament;


class DepartamentRepository
{

    public function all()
    {
        return Departament::latest()->get();
    }

    public function create(array $data)
    {   
        
        return Departament::create($data);
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
}