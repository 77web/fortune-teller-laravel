<?php

namespace App\Domain;

class ShowFortuneUseCase
{
    /**
     * @var DecideSign
     */
    private $decideSign;

    private $fetchFortune;

    public function showFortune(\DateTimeInterface $birthday) // TODO ここでreturn typeとしてFortuneがほしいがEloquent Modelなので使いたくない
    {
        $targetSign = $this->decideSign->decideSign($birthday);
        abort_unless($targetSign, 400); // TODO abort_unlessはLaravelの関数なので使いたくない

        $fortune = $this->fetchFortune->fetchTodaysFortune($targetSign); // TODO FetchFortuneはEloquentに依存しているので使いたくない
        abort_unless($fortune, 400);  // TODO abort_unlessはLaravelの関数なので使いたくない

        return $fortune;
    }
}
