<?php

namespace Tests\Unit\Domain;

use App\Domain\DecideSign;
use App\Domain\FetchFortuneInterface;
use App\Domain\FortuneInterface;
use App\Domain\ShowFortuneException;
use App\Domain\ShowFortuneUseCase;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class ShowFortuneUseCaseTest extends TestCase
{
    /**
     * @var MockInterface|null
     */
    private $decideSignMock;

    /**
     * @var MockInterface|null
     */
    private $fetchFortuneMock;

    protected function setUp(): void
    {
        $this->decideSignMock = \Mockery::mock(DecideSign::class);
        $this->fetchFortuneMock = \Mockery::mock(FetchFortuneInterface::class);
    }

    protected function tearDown(): void
    {
        $this->decideSignMock = null;
        $this->fetchFortuneMock = null;

        \Mockery::close();
    }

    public function test()
    {
        $fortune = \Mockery::mock(FortuneInterface::class);

        $birthday = new \DateTimeImmutable();
        $this->decideSignMock->shouldReceive('decideSign')->with($birthday)->andReturn($sign = '乙女座')->once();
        $this->fetchFortuneMock->shouldReceive('fetchTodaysFortune')->with($sign)->andReturn($fortune)->once();

        $this->assertSame($fortune, $this->getSUT()->showFortune($birthday));
    }

    public function test_星座が見つからないときは例外()
    {
        $this->expectException(ShowFortuneException::class);

        $birthday = new \DateTimeImmutable();
        $this->decideSignMock->shouldReceive('decideSign')->with($birthday)->andReturn(null)->once();
        $this->fetchFortuneMock->shouldNotReceive('fetchTodaysFortune');

        $this->getSUT()->showFortune($birthday);
    }

    public function test_今日の運勢が見つからないときは例外()
    {
        $this->expectException(ShowFortuneException::class);

        $birthday = new \DateTimeImmutable();
        $this->decideSignMock->shouldReceive('decideSign')->with($birthday)->andReturn($sign = '乙女座')->once();
        $this->fetchFortuneMock->shouldReceive('fetchTodaysFortune')->with($sign)->andReturn(null)->once();

        $this->getSUT()->showFortune($birthday);
    }

    private function getSUT(): ShowFortuneUseCase
    {
        return new ShowFortuneUseCase(
            $this->decideSignMock,
            $this->fetchFortuneMock,
        );
    }
}
