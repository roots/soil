<?php
/*
Plugin Name:        Soil
Plugin URI:         https://roots.io/plugins/soil/
Description:        Clean up WordPress markup, use relative URLs, nicer search URLs, and disable trackbacks
Version:            3.1.0
Author:             Roots
Author URI:         https://roots.io/

License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

namespace Roots\Soil;

function load_modules() {
  foreach (glob(__DIR__ . '/modules/*.php') as $file) {
    if (current_theme_supports('soil-' . basename($file, '.php'))) {
      require_once $file;
    }
  }
}
add_action('after_setup_theme', __NAMESPACE__ . '\\load_modules');
