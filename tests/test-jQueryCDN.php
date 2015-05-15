<?php

require_once dirname(__DIR__) . "/modules/jquery-cdn.php";

use Roots\Soil\JqueryCDN;

class JqueryCDNTest extends WP_UnitTestCase {

  private $jquery_version = "1.11.2";

  public function setUp()
  {

    $GLOBALS['wp_scripts'] = new stdClass();
    $GLOBALS['wp_scripts']->registered = [];
    $GLOBALS['wp_scripts']->registered['jquery'] = new stdClass();
    $GLOBALS['wp_scripts']->registered['jquery']->ver = $this->jquery_version;
  }

  public function test_register_jquery_cdn()
  {
    JqueryCDN\register_jquery();
    wp_enqueue_script('jquery');
    ob_start();
    do_action('wp_footer');
    $footer = ob_get_flush();

    $this->assertEquals(
      "<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/{$this->jquery_version}/jquery.min.js'></script>",
      trim($footer)
    );
  }


}
