<?php

namespace Roots\Soil\Tests\Unit;

use Mockery as m;
use Roots\Soil\Tests\TestCase;
use Roots\Soil\Soil;

use function Roots\Soil\Tests\plugin_entrypoint;

class EntrypointTest extends TestCase
{
    /** @test */
    public function it_should_compile_a_list_of_modules()
    {
        $soil = m::mock(Soil::class);

        $soil->shouldReceive('discoverModules');

        include plugin_entrypoint();
    }
}
