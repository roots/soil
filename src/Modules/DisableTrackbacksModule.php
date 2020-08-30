<?php

namespace Roots\Soil\Modules;

use function wp_die;

/**
 * Disables trackbacks/pingbacks
 */
class DisableTrackbacksModule extends AbstractModule
{
    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name = 'disable-trackbacks';

    /**
     * Module handle.
     *
     * @return void
     */
    public function handle()
    {
        $this->filter('xmlrpc_methods', 'disablePingback');
        $this->filter('wp_headers', 'removePingbackHeaders');
        $this->filter('bloginfo_url', 'removePingbackUrl', 10, 2);
        $this->filter('xmlrpc_call', 'removePingbackXmlrpc');
        $this->filter('rewrite_rules_array', 'removeTrackbackRewriteRules');
    }

    /**
     * Disable pingback XMLRPC method.
     *
     * @internal Used by `xmlrpc_methods`
     *
     * @param array $methods
     * @return array
     */
    public function disablePingback($methods)
    {
        unset($methods['pingback.ping']);
        return $methods;
    }

    /**
     * Remove pingback headers.
     *
     * @internal Used by `wp_headers`
     *
     * @param array $headers
     * @return array
     */
    public function removePingbackHeaders($headers)
    {
        unset($headers['X-Pingback']);
        return $headers;
    }

    /**
     * Remove bloginfo('pingback_url').
     *
     * @internal Used by `bloginfo_url`
     *
     * @param string $output
     * @param string $show
     * @return string
     */
    public function removePingbackUrl($output, $show)
    {
        return $show === 'pingback_url' ? '' : $output;
    }

    /**
     * Disable XMLRPC pingback action.
     *
     * @internal Used by `xmlrpc_call`
     *
     * @param string $action
     * @return void
     */
    public function removePingbackXmlrpc($action)
    {
        if ($action === 'pingback.ping') {
            wp_die('Pingbacks are not supported', 'Not Allowed!', ['response' => 403]);
        }
    }

    /**
     * Remove trackback rewrite rules.
     *
     * @internal Used by `rewrite_rules_array`
     *
     * @param array $rules
     * @return array
     */
    public function removeTrackbackRewriteRules($rules)
    {
        foreach (array_keys($rules) as $rule) {
            if (preg_match('/trackback\/\?\$$/i', $rule)) {
                unset($rules[$rule]);
            }
        }
        return $rules;
    }
}
