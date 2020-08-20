<?php

namespace Roots\Soil\Modules;

use function esc_url;
use function remove_query_arg;

/**
 * Remove version query string from all styles and scripts
 */
class DisableAssetVersioningModule extends AbstractModule
{
    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name = 'disable-asset-versioning';

    /**
     * Module handle.
     *
     * @return void
     */
    public function handle()
    {
        $this->filters(['script_loader_src', 'style_loader_src'], 'removeVersionQueryVar', 15, 1);
    }

    /**
     * Remove `ver` query variable from URL.
     *
     * @internal Used by `script_loader_src` and `style_loader_src`
     *
     * @param string $url
     * @return string|bool
     */
    public function removeVersionQueryVar($url)
    {
        return $url ? esc_url(remove_query_arg('ver', $url)) : false;
    }
}
