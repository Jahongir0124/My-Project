<?php


namespace app\Services;

use App\Repositories\SemesterRepository;


class SemesterService
{
    public function __construct(protected readonly SemesterRepository $semestrRepository){}

    public function all()
    {
        return $this->semestrRepository->all();
    }


    public function create(array $data)
    {
        $this->semestrRepository->create($data);
    }


    public function update(array $data)
    {
        return $this->semestrRepository->update($data);
    }

    public function destroy(int $id)
    {
        return $this->semestrRepository->destroy($id);
    }
}