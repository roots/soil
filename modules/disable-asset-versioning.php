<?php

namespace Roots\Soil\DisableAssetVersioning;

/**
 * Remove version query string from all styles and scripts
 *
 * You can enable/disable this feature in functions.php (or lib/config.php if you're using Sage):
 * add_theme_support('soil-disable-asset-versioning');
 */
function remove_script_version($src) {
  return esc_url(remove_query_arg('ver', $src));
}
add_filter('script_loader_src', __NAMESPACE__ . '\\remove_script_version', 15, 1);
add_filter('style_loader_src', __NAMESPACE__ . '\\remove_script_version', 15, 1);
