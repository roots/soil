<?php

namespace Roots\Soil\Tests\Unit;

use Mockery as m;
use Roots\Soil\Exceptions\LifecycleException;
use Roots\Soil\Tests\Fixtures\Modules\CustomHookModule;
use Roots\Soil\Tests\Fixtures\Modules\CustomNameModule;
use Roots\Soil\Tests\Fixtures\Modules\StubModule;
use Roots\Soil\Tests\TestCase;

use function Brain\Monkey\Actions\expectDone;

class ModuleTest extends TestCase
{
    /** @test */
    public function it_should_attach_itself_to_its_hook_when_registered()
    {
        $module = new StubModule();
        $this->assertFalse(has_action('soil/init', $module));
        $module->register();
        $this->assertIsInt(has_action('soil/init', $module));

        $module = new CustomHookModule();
        $this->assertFalse(has_action('custom-hook', $module));
        $module->register();
        $this->assertIsInt(has_action('custom-hook', $module));
    }

    /** @test */
    public function it_can_only_be_registered_once()
    {
        $module = new StubModule();

        $module->register();

        $this->expectException(LifecycleException::class);

        $module->register();
    }

    /** @test */
    public function it_may_not_be_registered_after_its_hook()
    {
        do_action('soil/init');

        $module = new StubModule();
        $this->expectException(LifecycleException::class);
        $module->register();
    }

    /** @test */
    public function it_may_not_be_registered_during_its_hook()
    {
        $module = new StubModule();

        expectDone('soil/init')
            ->whenHappen(function ($module) {
                $module->register();
            });

        $this->expectException(LifecycleException::class);

        do_action('soil/init', $module);
    }

    /** @test */
    public function it_generates_its_own_provider_identity()
    {
        $this->assertEquals('stub', (new StubModule())->provides());
        $this->assertEquals('custom-hook', (new CustomHookModule())->provides());
        $this->assertEquals('foo-bar', (new CustomNameModule())->provides());
    }

    /** @test */
    public function it_should_call_its_handle_when_invoked_when_condition_is_true()
    {
        $module = m::mock(StubModule::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $module->shouldReceive('condition')
            ->andReturnTrue();

        $module->shouldReceive('handle')
            ->once()
            ->withNoArgs();

        $module();
    }

    /** @test */
    public function it_should_not_call_its_handle_when_invoked_when_condition_is_false()
    {
        $module = m::mock(StubModule::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $module->shouldReceive('condition')
            ->andReturnFalse();

        $module->shouldNotReceive('handle');

        $module();
    }
}
