<?php

namespace Tests\Feature;

use Tests\CreatesApplication;
use Tests\TestCase;

class FortuneControllerTest extends TestCase
{
    protected function setUp(): void
    {
        $this->app = $this->createApplication();
    }

    public function test_index()
    {
        $response = $this->get('/');

        $this->assertTrue($response->isOk(), $response->getStatusCode());
    }
}
