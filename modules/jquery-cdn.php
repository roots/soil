<?php

namespace Roots\Soil\JqueryCDN;

/**
 * Load jQuery from Google's CDN with a local fallback
 *
 * You can enable/disable this feature in functions.php (or lib/config.php if you're using Sage):
 * add_theme_support('soil-jquery-cdn');
 */
function register_jquery() {
  if (!is_admin()) {
    $jquery_version = $GLOBALS['wp_scripts']->registered['jquery']->ver;

    wp_deregister_script('jquery');

    wp_register_script(
      'jquery',
      'https://ajax.googleapis.com/ajax/libs/jquery/' . $jquery_version . '/jquery.min.js',
      [],
      null,
      true
    );

    add_filter('script_loader_src', __NAMESPACE__ . '\\jquery_local_fallback', 10, 2);
  }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\register_jquery', 100);

/**
 * Output the local fallback immediately after jQuery's <script>
 *
 * @link http://wordpress.stackexchange.com/a/12450
 */
function jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . $add_jquery_fallback .'"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = apply_filters('script_loader_src', \includes_url('/js/jquery/jquery.js'), 'jquery-fallback');
  }

  return $src;
}
add_action('wp_head', __NAMESPACE__ . '\\jquery_local_fallback');
