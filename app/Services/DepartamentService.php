<?php 



namespace app\Services;
use App\Repositories\DepartamentRepository;
use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\DB;

class DepartamentService
{
    public function __construct(
        protected  DepartamentRepository $departamentRepository,
        protected CourseRepository $courseRepository
        ){}

    public function all()
    {
        return $this->departamentRepository->all();
    }


    public function create(array $data)
    {

        return DB::transaction(function () use ($data){
            $faculity = $this->departamentRepository->create($data['name']);

            // $this->courseRepository->createMany($faculity, $data['courses'] ?? []);

            return $faculity;
        });
        
    }

   

    public function getByFilter($data)
    {
        return $this->departamentRepository->getByFilter($data);
    }

    public function update(array $data)
    {
        return $this->departamentRepository->update($data);
    }

    public function destroy(int $id)
    {
        return $this->departamentRepository->destroy($id);
    }

    
}