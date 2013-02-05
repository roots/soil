<?php
/*
Plugin Name:  Must Use Plugins Loader
Plugin URI:   http://benword.com/
Description:  Options Framework, CMB, CF Post Formats, and site-specific functionality (custom post types, taxonomies, meta boxes, shortcodes)
Version:      1.0
Author:       Ben Word
Author URI:   http://benword.com/
*/

require WPMU_PLUGIN_DIR . '/options-framework-plugin/options-framework.php';
require WPMU_PLUGIN_DIR . '/wp-post-formats/cf-post-formats.php';

// Site specific custom post types, taxonomies, meta boxes and shortcodes
require WPMU_PLUGIN_DIR . '/base/base.php';

// Load CMB
function load_cmb() {
  if (!is_admin()) {
    return;
  }

  require WPMU_PLUGIN_DIR . '/cmb/init.php';
}
add_action('init', 'load_cmb');
