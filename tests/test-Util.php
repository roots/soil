<?php

namespace Roots\Soil\Tests;

use Mockery;
use Brain\Monkey;
use Brain\Monkey\Functions;
use Brain\Monkey\Actions;
use Roots\Soil\Utils;

class UtilTest extends TestCase {

  public function setUp()
  {
    parent::setUp();

    require_once dirname(__DIR__) . "/lib/utils.php";
  }

  public function testRootRelativeUrl()
  {
    // @joemaller has tests incoming
  }

  public function testUrlCompare()
  {
    // @joemaller has tests incoming
  }

  public function testAddFilters()
  {
    Utils\add_filters(
      ['filter_this', 'filter_that'],
      [$this, 'callbackTest']
    );
    $this->assertTrue(has_filter('filter_this', [$this, 'callbackTest']));
    $this->assertTrue(has_filter('filter_that', [$this, 'callbackTest']));

    /**
     * Pass in a string
     */
    Utils\add_filters(
      'filter_string',
      [$this, 'callbackTest']
    );
    $this->assertTrue(has_filter('filter_string', [$this, 'callbackTest']));

    /**
     * Test priorities
     */
    Utils\add_filters(
      ['filter_priorities', 'filter_more_priorities'],
      [$this, 'callbackTest'],
      50
    );
    $this->assertTrue(has_filter('filter_priorities', [$this, 'callbackTest'], 50));
    $this->assertTrue(has_filter('filter_more_priorities', [$this, 'callbackTest'], 50));
  }

  public function testAlerts()
  {
    // Having trouble with this one
  }

  /**
   * Empty function to be used as a callback
   */
  public function callbackTest() {}
}
