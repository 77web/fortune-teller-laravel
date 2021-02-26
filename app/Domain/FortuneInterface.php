<?php

namespace App\Domain;

interface FortuneInterface
{
    public function getTargetDate(): ?\DateTimeImmutable;
    public function getTargetSign(): ?string;
    public function getFortuneText(): ?string;
}
