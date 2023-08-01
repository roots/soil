<?php

namespace Roots\Soil\Modules;

use function Roots\Soil\is_production_environment;

/**
 * Moves all scripts to wp_footer action
 */
class GoogleAnalyticsModule extends AbstractModule
{
    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name = 'google-analytics';

    /**
     * Default options.
     *
     * @var array
     */
    protected $defaults = [
        /**
         * Enable this module.
         *
         * @var bool
         */
        'enabled' => true,

        /**
         * This is to go live with GA.
         *
         * This should be false in non-production.
         *
         * @var bool
         */
        'should_load' => false,

        /**
         * Google Analytics ID
         *
         * This is also known as your "property ID" or "measurement ID"
         *
         * Format: UA-XXXXX-Y
         *
         * @var string
         */
        'google_analytics_id' => null,

        /**
         * Additional Google Tags
         *
         * Format: [['key', 'value', ['optional' => 'parameters']]]
         *
         * @link https://developers.google.com/tag-platform/gtagjs/configure
         *
         * @var array
         */
        'tags' => [],
    ];

    /**
     * Name of the hook at which this module will run.
     *
     * @var string
     */
    protected $hook = 'wp_head';

    /**
     * Generate Options object based on input options array.
     *
     * @param array|Options $options
     * @return Options
     */
    protected function processOptions($options)
    {
        $options = parent::processOptions($options);

        if (isset($options->options)) {
            $options->google_analytics_id = $options->options;
            unset($options->options);
        }

        if (!$options->should_load) {
            $options->should_load = !empty($options->google_analytics_id)
                && is_production_environment()
                && !current_user_can('manage_options');
        }

        if (!empty($options->tags)) {
            $options->tags = array_map(function ($tag) {
                return array_map(function ($value) {
                    if (is_array($value)) {
                        return wp_json_encode($value);
                    }

                    return "'{$value}'";
                }, $tag);
            }, $options->tags);
        }

        return $options;
    }

    /**
     * Module handle.
     *
     * @return void
     */
    public function handle()
    {
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $this->render();
    }
}
