<?php

namespace Tests\Unit\Domain;

use App\Domain\DecideSign;
use PHPUnit\Framework\TestCase;

class DecideSignTest extends TestCase
{
    public function test_山羊座_12月()
    {
        $this->do_test('山羊座', new \DateTimeImmutable('2021-12-25'));
    }

    public function test_山羊座_1月()
    {
        $this->do_test('山羊座', new \DateTimeImmutable('2021-01-01'));
    }

    public function test_水瓶座()
    {
        $this->do_test('水瓶座', new \DateTimeImmutable('2021-01-25'));
    }

    private function do_test(string $expectedSign, \DateTimeInterface $birthday)
    {
        $SUT = new DecideSign();
        $this->assertEquals($expectedSign, $SUT->decideSign($birthday));
    }
}
