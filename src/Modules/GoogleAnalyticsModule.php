<?php

namespace Roots\Soil\Modules;

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
     * Name of the hook at which this module will run.
     *
     * @var string
     */
    protected $hook = 'wp_head';

    /**
     * Module handle.
     *
     * @return void
     */
    public function handle()
    {
        echo $this->render([
            'should_load' => null,
            'google_analytics_id' => null,
            'optimize_id' => null,
            'anonymize_ip' => null,
        ]);
    }
}
