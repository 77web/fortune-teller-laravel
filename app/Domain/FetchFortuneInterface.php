<?php

namespace App\Domain;

interface FetchFortuneInterface
{
    public function fetchTodaysFortune(string $targetSign): ?FortuneInterface;
}
