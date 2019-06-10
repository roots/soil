<?php

namespace Roots\Soil\DisableRestApi;

/**
 * Disable WordPress REST API
 *
 * You can enable/disable this feature in functions.php (or app/setup.php if you're using Sage):
 * add_theme_support('soil-disable-rest-api');
 */
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('template_redirect', 'rest_output_link_header', 11);
remove_action('wp_head', 'rest_output_link_wp_head', 10);

add_filter('rest_authentication_errors', function ($result) {
  if (!empty($result)) {
    return $result;
  }

  if (!is_user_logged_in()) {
    return new WP_Error('rest_not_logged_in', 'You are not currently logged in.', ['status' => 401]);
  }

  return $result;
});
