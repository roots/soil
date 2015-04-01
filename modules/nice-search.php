<?php

namespace Roots\Soil\NiceSearch;

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 *
 * You can enable/disable this feature in functions.php (or lib/config.php if you're using Sage):
 * add_theme_support('soil-nice-search');
 */
function redirect() {
  global $wp_rewrite;
  if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->get_search_permastruct()) {
    return;
  }

  $search_base = $wp_rewrite->search_base;
  if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
    wp_redirect(get_search_link());
    exit();
  }
}
add_action('template_redirect', __NAMESPACE__ . '\\redirect');

function rewrite($url) {
  return str_replace('/?s=', '/search/', $url);
}
add_filter('wpseo_json_ld_search_url', __NAMESPACE__ . '\\rewrite');
