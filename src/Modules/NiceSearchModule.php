<?php

namespace Roots\Soil\Modules;

use function is_search;
use function wp_safe_redirect;
use function get_search_link;

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 */
class NiceSearchModule extends AbstractModule
{
    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name = 'nice-search';

    /**
     * Module handle.
     *
     * @return void
     */
    public function handle()
    {
        $this->filter('template_redirect', 'redirect');

        $this->compat();
    }

    /**
     * Redirect query string search results to pretty URL.
     *
     * @internal Used by `template_redirect`
     *
     * @return void
     */
    public function redirect()
    {
        global $wp_rewrite;

        if (!isset($_SERVER['REQUEST_URI']) || !isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->get_search_permastruct()) {
            return;
        }

        // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
        $request = wp_unslash(filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL));

        $search_base = $wp_rewrite->search_base;

        if (
            is_search()
            && strpos($request, "/{$search_base}/") === false
            && strpos($request, '&') === false
        ) {
            wp_safe_redirect(get_search_link());
            exit;
        }
    }

    /**
     * Rewrite query string search URL as pretty URL.
     *
     * @internal Used by `wpseo_json_ld_search_url`
     *
     * @param string $url
     * @return string
     */
    public function rewrite($url)
    {
        return str_replace('/?s=', '/search/', $url);
    }

    /**
     * Add compatibility with third-party plugins.
     *
     * @return void
     */
    protected function compat()
    {
        $this->compatYoastSeo();
    }

    /**
     * Add compatibility for Yoast SEO.
     *
     * @return void
     */
    protected function compatYoastSeo()
    {
        $this->filter('wpseo_json_ld_search_url', 'rewrite');
    }
}
