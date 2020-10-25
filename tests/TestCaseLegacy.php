<?php

namespace Roots\Soil\Tests;

use Brain\Monkey;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

use function Brain\Monkey\Functions\stubs;

class TestCaseLegacy extends FrameworkTestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp()
    {
        Monkey\setUp();
        parent::setUp();

        stubs([
            'esc_attr',
            'esc_html',
            '__',
            '_x',
            'esc_attr__',
            'esc_html__',
        ]);
    }

    protected function tearDown()
    {
        Monkey\tearDown();
        parent::tearDown();
    }

    /**
     * Asserts that a variable is of a given type.
     *
     * @param mixed $actual
     * @param string $message
     *
     * @return void
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert int $actual
     */
    public static function assertIsInt($actual, $message = '')
    {
        static::assertInternalType('int', $actual);
    }
}
