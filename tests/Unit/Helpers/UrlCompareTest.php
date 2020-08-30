<?php

namespace Roots\Soil\Tests\Unit\Helpers;

use PHPUnit\Framework\TestCase;

use function Roots\Soil\compare_base_url;

class UrlCompareTest extends TestCase
{
    /** @test */
    public function it_should_handle_two_equal_urls()
    {

        $this->assertTrue(compare_base_url('https://example.test', 'https://example.test'));
        $this->assertTrue(compare_base_url('https://example.test', 'https://example.test/'));
    }

    /** @test */
    public function it_should_handle_relative_urls()
    {
        $this->assertTrue(compare_base_url('https://example.test', '/'));
        $this->assertTrue(compare_base_url('https://example.test', '/foobar'));

        $this->assertTrue(compare_base_url('/', '/foobar'));
        $this->assertFalse(compare_base_url('/foobar', 'https://example.test/foobar'));
    }

    /** @test */
    public function it_should_handle_url_without_scheme()
    {
        $this->assertFalse(compare_base_url('https://example.test', '//foobar.test'));
        $this->assertTrue(compare_base_url('https://example.test', '//example.test'));

        $this->assertFalse(compare_base_url('//foobar.test', 'https://example.test'));
        $this->assertFalse(compare_base_url('//foobar.test', 'http://example.test'));
    }

    /** @test */
    public function it_should_handle_url_with_different_scheme()
    {
        $this->assertFalse(compare_base_url('https://example.test/', 'http://example.test/', true));
        $this->assertTrue(compare_base_url('https://example.test/', 'http://example.test/', false));
    }

    /** @test */
    public function it_should_handle_url_with_different_hosts()
    {
        $this->assertFalse(compare_base_url('https://example.test', 'https://foobar.test'));
    }

    /** @test */
    public function it_should_handle_url_with_ports()
    {
        $this->assertTrue(compare_base_url('https://example.test:8080', 'https://example.test:8080/biz/baz'));
        $this->assertFalse(compare_base_url('https://example.test:8080', 'https://example.test/biz/baz'));
        $this->assertFalse(compare_base_url('https://example.test', 'https://example.test:8080/biz/baz'));
    }
}
