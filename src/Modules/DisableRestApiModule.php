<?php

namespace Roots\Soil\Modules;

use WP_Error;

use function __;
use function remove_action;
use function rest_authorization_required_code;

/**
 * Disable WordPress REST API
 */
class DisableRestApiModule extends AbstractModule
{
    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name = 'disable-rest-api';

    /**
     * Module handle.
     *
     * @return void
     */
    public function handle()
    {
        remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
        remove_action('template_redirect', 'rest_output_link_header', 11);
        remove_action('wp_head', 'rest_output_link_wp_head', 10);

        $this->filter('rest_authentication_errors', 'restAuthenticationError', 15);
    }

    /**
     * Return an error when REST API is accessed.
     *
     * @internal Used by `rest_authentication_errors`
     *
     * @return WP_Error
     */
    public function restAuthenticationError()
    {
        return new WP_Error(
            'rest_forbidden',
            __('REST API forbidden.', 'soil'),
            ['status' => rest_authorization_required_code()]
        );
    }
}
