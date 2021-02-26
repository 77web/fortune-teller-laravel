<?php

namespace App\Service;

use App\Domain\FetchFortuneInterface;
use App\Domain\FortuneInterface;
use App\Models\Fortune;

class FetchFortune implements FetchFortuneInterface
{
    public function fetchTodaysFortune(string $targetSign): ?FortuneInterface
    {
        return Fortune::query()->where('target_date', date('Y-m-d'))->where('target_sign', $targetSign)->get()->first();
    }
}
