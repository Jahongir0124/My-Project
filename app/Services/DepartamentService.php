<?php 



namespace app\Services;
use App\Repositories\DepartamentRepository;



class DepartamentService
{
    public function __construct(protected  DepartamentRepository $departamentRepository)
    {
        
    }

    public function all()
    {
        return $this->departamentRepository->all();
    }


    public function create(array $data)
    {
        return $this->departamentRepository->create($data);
    }

    public function getAllStudentByDepartament()
    {
        
    }

    public function getByFilter($data)
    {
        return $this->departamentRepository->getByFilter($data);
    }
}