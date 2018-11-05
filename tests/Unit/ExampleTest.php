<?php

namespace Tests\Unit;

use App\Tools\DatePostpone;
use App\Tools\StringGenerator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        var_dump(StringGenerator::generate(4));
    }
}
