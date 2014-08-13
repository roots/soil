<?php
/**
 * Disables trackbacks/pingbacks
 *
 * You can enable/disable this feature in functions.php (or lib/config.php if you're using Roots):
 * add_theme_support('soil-disable-trackbacks');
 */

/**
 * Disable pingback XMLRPC method
 */
function soil_filter_xmlrpc_method($methods) {
  unset($methods['pingback.ping']);
  return $methods;
}
add_filter('xmlrpc_methods', 'soil_filter_xmlrpc_method', 10, 1);

/**
 * Remove pingback header
 */
function soil_filter_headers($headers) {
  if (isset($headers['X-Pingback'])) {
    unset($headers['X-Pingback']);
  }
  return $headers;
}
add_filter('wp_headers', 'soil_filter_headers', 10, 1);

/**
 * Kill trackback rewrite rule
 */
function soil_filter_rewrites($rules) {
  foreach($rules as $rule => $rewrite) {
    if (preg_match('/trackback\/\?\$$/i', $rule)) {
      unset($rules[$rule]);
    }
  }
  return $rules;
}
add_filter('rewrite_rules_array', 'soil_filter_rewrites');

/**
 * Kill bloginfo('pingback_url')
 */
function soil_kill_pingback_url($output, $show) {
  if ($show === 'pingback_url') {
    $output = '';
  }
  return $output;
}
add_filter('bloginfo_url', 'soil_kill_pingback_url', 10, 2);

/**
 * Disable XMLRPC call
 */
function soil_kill_xmlrpc($action) {
  if ('pingback.ping' === $action) {
    wp_die(
      'Pingbacks are not supported',
      'Not Allowed!',
      array('response' => 403)
    );
  }
}
add_action('xmlrpc_call', 'soil_kill_xmlrpc');
