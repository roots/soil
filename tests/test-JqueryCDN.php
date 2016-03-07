<?php

namespace Roots\Soil\Tests;

use stdClass;
use Mockery;
use Brain\Monkey;
use Brain\Monkey\Functions;
use Roots\Soil\JqueryCDN;

class JqueryCDNTest extends TestCase {

  private $jquery_version = "1.11.2";

  public function setUp()
  {
    parent::setUp();
    Functions::when('includes_url')->justReturn('http://example.com/wp/wp-includes');

    $GLOBALS['wp_scripts'] = new stdClass();
    $GLOBALS['wp_scripts']->registered = [];
    $GLOBALS['wp_scripts']->registered['jquery'] = new stdClass();
    $GLOBALS['wp_scripts']->registered['jquery']->ver = $this->jquery_version;

    require_once dirname(__DIR__) . "/modules/jquery-cdn.php";
  }

  public function testJqueryFallback()
  {
    $jquery_src = includes_url('/js/jquery/jquery.js');
    JqueryCDN\jquery_local_fallback($jquery_src, 'jquery');

    ob_start();
    JqueryCDN\jquery_local_fallback($jquery_src);
    $output = ob_get_flush();

    $this->assertEquals(
      '<script>window.jQuery || document.write(\'<script src="' . $jquery_src .'"><\/script>\')</script>',
      trim($output)
    );
  }
}
