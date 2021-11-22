<?php

/**
 * Convert full URL paths to absolute paths.
 *
 * Removes the http or https protocols and the domain. Keeps the path '/' at the
 * beginning, so it isn't a true relative link, but from the web root base.
 *
 * @link https://github.com/WordPress/WordPress/blob/5.5/wp-includes/formatting.php#L4611-L4625
 *
 * @param string $link Full URL path.
 * @return string Absolute path.
 */
function wp_make_link_relative($link)
{
    return preg_replace('|^(https?:)?//[^/]+(/?.*)|i', '$2', $link);
}

/**
 * Appends a trailing slash.
 *
 * Will remove trailing forward and backslashes if it exists already before adding
 * a trailing forward slash. This prevents double slashing a string or path.
 *
 * The primary use of this is for paths and thus should be used for paths. It is
 * not restricted to paths and offers no specific path support.
 *
 * @link https://github.com/WordPress/WordPress/blob/5.5/wp-includes/formatting.php#L2686-L2702
 *
 * @param string $string What to add the trailing slash to.
 * @return string String with trailing slash added.
 */
function trailingslashit($url)
{
    return rtrim($url, '/\\') . '/';
}

/**
 * Parse a URL and return its components
 *
 * @param string $url
 * @param int $component
 * @return array|string|int|null|false
 */
function wp_parse_url($url, $component = -1)
{
    // phpcs:ignore WordPress.WP.AlternativeFunctions.parse_url_parse_url
    return parse_url($url, $component);
}
