<?php
/**
 * Custom shortcodes
 */

/**
 * [rotator] shortcode
 *
 * Output posts from the base_rotator custom post type
 * Use location="" attribute to pull in posts from a specific location
 * from the base_rotator_location taxonomy
 *
 * Example:
 * [rotator location="home"]
 */
function base_shortcode_rotator($atts) {
  extract(shortcode_atts(array(
    'location' => ''
  ), $atts));

  ob_start();
  include(dirname(dirname(__FILE__)) . '/templates/shortcode-rotator.php');
  return ob_get_clean();
}
add_shortcode('rotator', 'base_shortcode_rotator');
