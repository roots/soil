<?php
/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 *
 * You can enable/disable this feature in functions.php (or lib/config.php if you're using Roots):
 * add_theme_support('soil-nice-search');
 */
function soil_nice_search_redirect() {
  global $wp_rewrite;
  if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
    return;
  }

  $search_base = $wp_rewrite->search_base;
  if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {

    // Parse and retain any additional query string arguments:
    $qs = array();
    parse_str( $_SERVER['QUERY_STRING'], $qs );
    unset( $qs['s'] );

    $s     = urlencode( get_query_var( 's' ) );
    $query = empty( $qs ) ? '' : sprintf( '?%s', http_build_query( $qs ) );
    $url   = home_url( sprintf( '/%s/%s%s', $search_base, $s, $query ) );

    wp_redirect( $url );
    exit();
  }
}
add_action('template_redirect', 'soil_nice_search_redirect');
