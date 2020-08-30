<?php

namespace Roots\Soil\Tests\Unit;

use Mockery as m;
use Roots\Soil\Modules\AbstractModule;
use Roots\Soil\Tests\TestCase;
use Roots\Soil\Soil;
use Roots\Soil\Tests\Fixtures\Modules\CustomHookModule;
use Roots\Soil\Tests\Fixtures\Modules\CustomNameModule;
use Roots\Soil\Tests\Fixtures\Modules\StubModule;

use function Roots\Soil\Tests\fixture;

class SoilTest extends TestCase
{
    /** @test */
    public function it_should_register_modules_when_invoked()
    {
        $module = m::mock(AbstractModule::class)->makePartial();

        $module->shouldReceive('provides');

        $soil = new Soil([$module], [$module->provides()]);

        $module->shouldReceive('register')
            ->once()
            ->with(['enabled' => true]);

        $soil();
    }

    /** @test */
    public function it_should_fire_init_hook_when_invoked()
    {
        $module = new StubModule();
        $soil = new Soil([$module], [$module->provides()]);

        $soil();

        $this->assertEquals(1, did_action('soil/init'));
    }

    /** @test */
    public function it_should_discover_modules()
    {
        $modules = Soil::discoverModules(fixture('modules/*.php'), 'Roots\Soil\Tests\Fixtures\Modules');

        $this->assertCount(3, $modules);
        $this->assertSame([
            CustomHookModule::class,
            CustomNameModule::class,
            StubModule::class
        ], $modules);
    }
}
