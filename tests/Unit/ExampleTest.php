<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        (string) Str::orderedUuid();

        $response = $this->get('/');

        $response->assertStatus(200);
        $this->assertTrue(true);
    }
}
