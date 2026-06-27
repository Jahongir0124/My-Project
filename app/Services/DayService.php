<?php



namespace app\Services;
use App\Repositories\DayRepository;


class DayService
{
    public function __construct(protected readonly DayRepository $dayRepository)
    {}


    public function days()
    {
        return $this->dayRepository->days();
    }
}