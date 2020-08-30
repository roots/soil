<?php

namespace Roots\Soil\Tests\Unit\Modules;

use Roots\Soil\Modules\RelativeUrlsModule;
use Roots\Soil\Tests\TestCase;

use function Brain\Monkey\Functions\stubs;

class RelativeUrlsModuleTest extends TestCase
{
    /** @test */
    public function it_should_return_a_relative_url()
    {
        $module = new RelativeUrlsModule();
        stubs([
            'is_feed' => false,
            'network_home_url' => 'https://example.test/'
        ]);

        $this->assertEquals('/about-us', $module->relativeUrl('https://example.test/about-us'));
        $this->assertEquals('https://google.com/about', $module->relativeUrl('https://google.com/about'));

        $this->assertEquals('/about-us', $module->relativeUrl('//example.test/about-us'));
        $this->assertEquals('//google.com/about', $module->relativeUrl('//google.com/about'));
    }

    /** @test */
    public function it_should_never_return_a_relative_url_for_rss_feed()
    {
        $module = new RelativeUrlsModule();
        stubs([
            'is_feed' => true,
            'network_home_url' => 'https://example.test/'
        ]);

        $this->assertEquals('https://example.test/about-us', $module->relativeUrl('https://example.test/about-us'));
        $this->assertEquals('//example.test/about-us', $module->relativeUrl('//example.test/about-us'));
    }

    /** @test */
    public function it_should_make_all_srcset_urls_relative()
    {
        $module = new RelativeUrlsModule();
        stubs([
            'is_feed' => false,
            'network_home_url' => 'https://example.test/'
        ]);

        $sources = [
            ['url' => 'https://example.test/app/uploads/example.jpg'],
            ['url' => 'https://example.test/app/uploads/example-200x200.jpg'],
            ['url' => 'https://example.test/app/uploads/example-600x600.jpg'],
        ];

        $this->assertEquals([
            ['url' => '/app/uploads/example.jpg'],
            ['url' => '/app/uploads/example-200x200.jpg'],
            ['url' => '/app/uploads/example-600x600.jpg'],
        ], $module->imageSrcset($sources));
    }
}
