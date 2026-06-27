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
        return Semester::findOrFail($id)->delete();
    }
    public function getSemesterById($id)
    {
        return Semester::findOrFail($id);
    }
    public function getUsedSemesterGroup($ids)
    {
        return Semester::whereNotIn('id', $ids)->get();
    }

    public function getActiveSemester()
    {
        return Semester::where('is_ative', 1)->first();
    }

    public function findById(int $id)
    {
        return Semester::findOrFail($id);
    }
}