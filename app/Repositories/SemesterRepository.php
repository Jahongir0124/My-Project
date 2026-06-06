<?php



namespace app\Repositories;



use App\Models\Semester;

class SemesterRepository
{
    
    public function all()
    {
        return Semester::latest()->get();
    }

    public function create(array $data)
    {
        return Semester::create($data);
    }

    public function update(array $data)
    {
        $semester = Semester::findOrFail($data['id']);
        $semester->update([
            "name" => $data['name'],
            "start_date" => $data['start_date'],
            "end_date" => $data['end_date']
        ]);
        return $semester->fresh();
       
    }

    public function destroy(int $id): bool
    {
        $semesnter = Semester::findOrFail($id);
        return $semesnter->delete();
        
    }


    public function getSemesterById($id)
    {
        return Semester::findOrFail($id);
    }
}