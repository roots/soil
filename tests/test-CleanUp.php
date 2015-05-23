<?php

namespace Roots\Soil\Tests;

use Brain\Monkey\Functions;
use Roots\Soil\CleanUp;
use Brain\Monkey\WP\Filters;
use Brain\Monkey\WP\Actions;

class CleanUpTest extends TestCase {


  public function setUp()
  {
    parent::setUp();

    Functions::expect('__return_false')->andReturn(false);

    require_once dirname(__DIR__) . "/modules/clean-up.php";
  }

  public function testRemoveDefaultDescription()
  {
    /**
     * Test that a non-standard tagline is returned
     */
    $tagline = 'Roots rules! Roots rules!';
    $this->assertSame(CleanUp\remove_default_description($tagline), $tagline);

    /**
     * Test that the default tagline is removed
     */
    $this->assertSame(CleanUp\remove_default_description('Just another WordPress site'), '');
  }
}
