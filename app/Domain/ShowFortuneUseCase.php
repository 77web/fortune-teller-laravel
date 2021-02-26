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

    /**
     * @param \DateTimeInterface $birthday
     * @return FortuneInterface
     * @throws ShowFortuneException
     */
    public function showFortune(\DateTimeInterface $birthday): FortuneInterface
    {
        $targetSign = $this->decideSign->decideSign($birthday);
        if ($targetSign === null) {
            throw new ShowFortuneException(sprintf('%s生まれの星座が決定できません', $birthday->format('Y-m-d')));
        }

        $fortune = $this->fetchFortune->fetchTodaysFortune($targetSign);
        if ($fortune === null) {
            throw new ShowFortuneException(sprintf('%sの今日の運勢が見つかりません', $targetSign));
        }

        return $fortune;
    }
}
