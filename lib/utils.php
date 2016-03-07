<?php

namespace Roots\Soil\Utils;

/**
 * Make a URL relative
 */
function root_relative_url($input) {
  if (is_feed()) {
    return $input;
  }

  $url = parse_url($input);
  if (!isset($url['host']) || !isset($url['path'])) {
    return $input;
  }
  $site_url = parse_url(network_home_url());  // falls back to home_url

  if (!isset($url['scheme'])) {
    $url['scheme'] = $site_url['scheme'];
  }
  $hosts_match = $site_url['host'] === $url['host'];
  $schemes_match = $site_url['scheme'] === $url['scheme'];
  $ports_exist = isset($site_url['port']) && isset($url['port']);
  $ports_match = ($ports_exist) ? $site_url['port'] === $url['port'] : true;

  if ($hosts_match && $schemes_match && $ports_match) {
    return wp_make_link_relative($input);
  }
  return $input;
}

/**
 * Compare URL against relative URL
 */
function url_compare($url, $rel) {
  $url = trailingslashit($url);
  $rel = trailingslashit($rel);
  return ((strcasecmp($url, $rel) === 0) || root_relative_url($url) == $rel);
}

/**
 * Hooks a single callback to multiple tags
 */
function add_filters($tags, $function, $priority = 10, $accepted_args = 1) {
  foreach ((array) $tags as $tag) {
    add_filter($tag, $function, $priority, $accepted_args);
  }
}

/**
 * Display error alerts in admin panel
 */
function alerts($errors, $capability = 'activate_plugins') {
  if (!did_action('init')) {
    return add_action('init', function () use ($errors, $capability) {
      alerts($errors, $capability);
    });
  }
  $alert = function ($message) {
    echo '<div class="error"><p>' . $message . '</p></div>';
  };
  if (call_user_func_array('current_user_can', (array) $capability)) {
    add_action('admin_notices', function () use ($alert, $errors) {
      array_map($alert, (array) $errors);
    });
  }
}
