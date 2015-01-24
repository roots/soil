<?php
/*
Plugin Name:        Soil
Plugin URI:         http://roots.io/plugins/soil/
Description:        Clean up WordPress markup, use relative URLs, nicer search URLs, and disable trackbacks
Version:            3.0.3
Author:             Roots
Author URI:         http://roots.io/

License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

namespace Roots\Soil;

define('SOIL_PATH', plugin_dir_path(__FILE__));

function load_modules() {
  if (current_theme_supports('soil-clean-up')) {
    require_once(SOIL_PATH . 'modules/clean-up.php');
  }

  if (current_theme_supports('soil-relative-urls')) {
    require_once(SOIL_PATH . 'modules/relative-urls.php');
  }

  if (current_theme_supports('soil-nice-search')) {
    require_once(SOIL_PATH . 'modules/nice-search.php');
  }

  if (current_theme_supports('soil-disable-trackbacks')) {
    require_once(SOIL_PATH . 'modules/disable-trackbacks.php');
  }

  if (current_theme_supports('soil-disable-asset-versioning')) {
    require_once(SOIL_PATH . 'modules/disable-asset-versioning.php');
  }
}
add_action('after_setup_theme', __NAMESPACE__ . '\\load_modules');
