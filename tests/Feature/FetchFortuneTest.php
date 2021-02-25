<?php

namespace Tests\Feature;

use App\Models\Fortune;
use App\Service\FetchFortune;
use Tests\TestCase;

class FetchFortuneTest extends TestCase
{
    /**
     * @var FetchFortune
     */
    private $SUT;

    protected function setUp(): void
    {
        $this->createApplication();

        Fortune::query()->truncate();
        $fortune = new Fortune;
        $fortune->setAttribute('target_sign', '山羊座');
        $fortune->setAttribute('target_date', date('Y-m-d'));
        $fortune->setAttribute('fortune_text', '今日の運勢は最高です！');
        $fortune->save();

        $this->SUT = new FetchFortune();
    }

    public function test_存在する()
    {
        $actual = $this->SUT->fetchTodaysFortune('山羊座');
        $this->assertNotNull($actual);
        $this->assertEquals('今日の運勢は最高です！', $actual->getAttribute('fortune_text'));
    }

    public function test_存在しない()
    {
        $actual = $this->SUT->fetchTodaysFortune('水瓶座');
        $this->assertNull($actual);
    }
}
