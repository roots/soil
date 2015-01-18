<?php

namespace Roots\Soil\RelativeURLs;

/**
 * Root relative URLs
 *
 * WordPress likes to use absolute URLs on everything - let's clean that up.
 * Inspired by http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_root_relative/
 *
 * You can enable/disable this feature in functions.php (or lib/config.php if you're using Roots):
 * add_theme_support('soil-relative-urls');
 */
function root_relative_url($input) {
  preg_match('|https?://([^/]+)(/.*)|i', $input, $matches);

  if (!isset($matches[1]) || !isset($matches[2])) {
    return $input;
  } elseif (($matches[1] === $_SERVER['SERVER_NAME']) || $matches[1] === $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']) {
    return wp_make_link_relative($input);
  } else {
    return $input;
  }
}

function enable_root_relative_urls() {
  return !(is_admin() || preg_match('/sitemap(_index)?\.xml/', $_SERVER['REQUEST_URI']) || in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')));
}

if (enable_root_relative_urls()) {
  $root_rel_filters = array(
    'bloginfo_url',
    'the_permalink',
    'wp_list_pages',
    'wp_list_categories',
    'the_content_more_link',
    'the_tags',
    'get_pagenum_link',
    'get_comment_link',
    'month_link',
    'day_link',
    'year_link',
    'term_link',
    'the_author_posts_link',
    'script_loader_src',
    'style_loader_src'
  );

  add_filters($root_rel_filters, __NAMESPACE__ . '\\root_relative_url');
}

function add_filters($tags, $function) {
  foreach($tags as $tag) {
    add_filter($tag, $function);
  }
}
