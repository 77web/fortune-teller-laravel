<?php

namespace App\Service;

use App\Models\Fortune;

class FetchFortune
{
    public function fetchTodaysFortune(string $targetSign)
    {
        return Fortune::query()->where('target_date', date('Y-m-d'))->where('target_sign', $targetSign)->get()->first();
    }
}
