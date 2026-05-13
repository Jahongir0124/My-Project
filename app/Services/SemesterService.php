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
}