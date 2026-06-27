<?php


namespace app\Services;
use App\Repositories\GroupRepository;
use App\Repositories\SemesterRepository;


class SemesterService
{
    public function __construct(
        protected readonly SemesterRepository $semestrRepository,
        protected readonly GroupRepository $groupRepository
        ){}

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
    public function getSemesterById($id)
    {
        return $this->semestrRepository->getSemesterById($id);
    }

    public function getUsedSemesterGroup(int $group_id)
    {
        $ids = $this->groupRepository->getGroupSemester($group_id);
        return $this->semestrRepository->getUsedSemesterGroup($ids);
    }


    public function findById(int $id)
    {
        return $this->semestrRepository->findById($id);
    }
    public function getActiveSemester()
    {
        return $this->semestrRepository->getActiveSemester();
    }

    

    
}