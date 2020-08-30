<?php

namespace Roots\Soil\Modules;

/**
 * Moves all scripts to wp_footer action
 */
class JsToFooterModule extends AbstractModule
{
    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name = 'js-to-footer';

    /**
     * Name of the hook at which this module will run.
     *
     * @var string
     */
    protected $hook = 'wp_enqueue_scripts';

    /**
     * Module handle.
     *
     * @return void
     */
    public function handle()
    {
        remove_action('wp_head', 'wp_print_scripts');
        remove_action('wp_head', 'wp_print_head_scripts', 9);
        remove_action('wp_head', 'wp_enqueue_scripts', 1);
    }
}
