<?php



namespace app\Repositories;

use App\Models\Teacher;



class TeacherRepository
{

    public function all()
    {
        return Teacher::latest()->get();
    }

    public function create(array $data)
    {
        $teacher = Teacher::create($data);
        return $teacher;
    }

    public function update(int $id, array $data)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($data);
        $teacher->full_name = $data['first_name']. " " . $data['last_name'];
        $teacher->save();
        return $teacher->fresh();
    }

    public function destroy(int $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->user->delete();
        return $teacher->delete();
    }


    public function filter($data)
    {
        $query = Teacher::query();

        if ($data->name)
            {
                $query->where(function ($q) use ($data) {
                    $q->where('first_name', 'like', '%' .$data->name. '%')
                    ->orWhere('last_name', 'like', '%'. $data->name .'%');
                });
            }

        if ($data->departament_id)
            {
                $query->where('departament_id', $data->departament_id);
            }

        if ($data->created_at)
            {
                if ($data->created_at == 'oldest')
                    {
                        $query->orderBy('created_at', 'asc');
                    }
                else 
                    {
                        $query->orderBy('created_at', 'desc');
                    }
            }

        return $query;
    }


    public function getTeacherByDepartament($departament)
    {
        return Teacher::where('departament_id', $departament)->get();
    }

}