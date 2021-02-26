<?php

namespace App\Domain;

class ShowFortuneUseCase
{
    /**
     * @var DecideSign
     */
    private $decideSign;

    /**
     * @var FetchFortuneInterface
     */
    private $fetchFortune;

    /**
     * ShowFortuneUseCase constructor.
     * @param DecideSign $decideSign
     * @param FetchFortuneInterface $fetchFortune
     */
    public function __construct(DecideSign $decideSign, FetchFortuneInterface $fetchFortune)
    {
        $this->decideSign = $decideSign;
        $this->fetchFortune = $fetchFortune;
    }

    public function showFortune(\DateTimeInterface $birthday): FortuneInterface
    {
        $targetSign = $this->decideSign->decideSign($birthday);
        abort_unless($targetSign, 400); // TODO abort_unlessはLaravelの関数なので使いたくない

        $fortune = $this->fetchFortune->fetchTodaysFortune($targetSign);
        abort_unless($fortune, 400);  // TODO abort_unlessはLaravelの関数なので使いたくない

        return $fortune;
    }
}
