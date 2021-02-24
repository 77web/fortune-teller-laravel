<?php

namespace Tests\Feature;

use App\Models\Fortune;
use Tests\CreatesApplication;
use Tests\TestCase;

class FortuneControllerTest extends TestCase
{
    protected function setUp(): void
    {
        $this->app = $this->createApplication();

        Fortune::query()->truncate();
    }

    public function test_index()
    {
        $response = $this->get('/');

        $this->assertTrue($response->isOk(), $response->getStatusCode());
    }

    public function test_show()
    {
        $fortune = new Fortune;
        $fortune->setAttribute('target_sign', '山羊座');
        $fortune->setAttribute('target_date', date('Y-m-d'));
        $fortune->setAttribute('fortune_text', $fortuneText = '今日の運勢は最高です！');
        $fortune->save();

        $response = $this->get('/show?birthday=1981-01-01');

        $this->assertTrue($response->isOk(), $response->getStatusCode());
        $this->assertTrue(mb_strpos($response->getContent(), $fortuneText) !== false);
    }

    public function test_show_該当する占いがない()
    {
        $response = $this->get('/show?birthday=1981-01-01');

        $this->assertEquals(400, $response->getStatusCode());

    }
}
