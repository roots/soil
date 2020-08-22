<?php

namespace Roots\Soil\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Roots\Soil\Options;

class OptionsTest extends TestCase
{
    /** @test */
    public function it_should_return_default_value_if_option_does_not_exist()
    {
        $data = ['foo' => 'bar'];

        $options = new Options($data);

        $this->assertNotEquals('baz', $options->get('foo', 'baz'));
        $this->assertEquals('baz', $options->get('biz', 'baz'));
    }

    /** @test */
    public function it_should_assume_indexed_array_is_list_of_boolean_keys()
    {
        $data = ['foo', 'bar'];

        $options = new Options($data);

        $this->assertTrue($options->get('foo'));
        $this->assertTrue($options->get('bar'));

        $this->assertNull($options->get('biz'));
        $options[] = 'biz';
        $this->assertTrue($options->get('biz'));

        $this->assertNull($options->get('baz'));
        $options[12345] = 'baz';
        $this->assertTrue($options->get('baz'));
    }

    /** @test */
    public function it_should_merge_data()
    {
        $data = [
            'foo' => 'bar'
        ];

        $options = new Options($data);

        $options->merge(['biz' => 'baz']);

        $this->assertEquals($options->get('foo'), 'bar');
        $this->assertEquals($options->get('biz'), 'baz');
    }

    /** @test */
    public function it_should_not_overwrite_merge_data()
    {
        $data = [
            'foo' => 'bar',
            'biz' => 'baz'
        ];

        $options = new Options($data);

        $this->assertEquals($options->get('biz'), 'baz');

        $options->merge(['biz' => 'not-baz']);

        $this->assertNotEquals($options->get('biz'), 'not-baz');
    }

    /** @test */
    public function it_should_overwrite_merge_data()
    {
        $data = [
            'foo' => 'bar',
            'biz' => 'baz'
        ];

        $options = new Options($data);

        $this->assertEquals($options->get('biz'), 'baz');

        $options->forceMerge(['biz' => 'not-baz']);

        $this->assertEquals($options->get('biz'), 'not-baz');
    }

    /** @test */
    public function it_should_be_countable()
    {
        $data = [
            'foo' => 'bar',
            'biz' => 'baz'
        ];

        $options = new Options($data);

        $this->assertEquals(2, count($options));
    }

    /** @test */
    public function it_should_behave_like_an_array()
    {
        $data = [
            'foo' => 'bar',
            'biz' => 'baz'
        ];

        $options = new Options($data);

        $this->assertTrue(isset($options['foo']));
        $this->assertFalse(isset($options['bad-key']));

        unset($options['foo']);
        $this->assertFalse(isset($options['foo']));

        $options['foo'] = 'bar';
        $this->assertEquals('bar', $options['foo']);
    }

    /** @test */
    public function it_should_behave_like_an_object()
    {
        $data = [
            'foo' => 'bar',
            'biz' => 'baz'
        ];

        $options = new Options($data);

        $this->assertTrue(isset($options->foo));
        $this->assertFalse(isset($options->bad_key));

        unset($options->foo);
        $this->assertFalse(isset($options->foo));

        $options->foo = 'bar';
        $this->assertEquals('bar', $options->foo);
    }

    public function it_should_be_iterable()
    {
        $data = [
            'foo' => 'bar',
            'biz' => 'baz'
        ];

        $options = new Options($data);
        $actual = [];

        foreach ($options as $key => $value) {
            $this->assertEquals($data[$key], $value);
            $actual[$key] = $value;
        }

        $this->assertSame($data, $actual);
    }
}
