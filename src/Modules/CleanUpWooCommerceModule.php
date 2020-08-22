<?php

namespace Roots\Soil\Modules;

use function is_woocommerce;
use function is_cart;
use function is_checkout;
use function remove_action;

/**
 * Clean up WooCommerce.
 *
 * Removes WC scripts and styles from non-WC pages.
 */
class CleanUpWooCommerceModule extends AbstractModule
{
    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name = 'woocommerce-cleanup';

    /**
     * Disable module when WooCommerce isn't loaded.
     *
     * {@inheritdoc}
     *
     * @return bool
     */
    protected function condition()
    {
        return class_exists('woocommerce') && parent::condition();
    }

    /**
     * Module handle.
     *
     * @return void
     */
    public function handle()
    {
        $this->filter('woocommerce_enqueue_styles', 'dequeueStyles');
        $this->filter('body_class', 'dequeueScripts');
        $this->filter('wp_print_styles', 'dequeueInlineStyles');
        $this->filter('init', 'removeGalleryNoscript');
        $this->filter('body_class', 'removeNoJS');
    }

    /**
     * Dequeue styles.
     *
     * @internal Used by `woocommerce_enqueue_styles`
     *
     * @return void
     */
    public function dequeueStyles()
    {
        return $this->isWooCommerce();
    }

    /**
     * Dequeue inline styles.
     *
     * @internal Used by `wp_print_styles`
     *
     * @return void
     */
    public function dequeueInlineStyles()
    {
        if ($this->isWooCommerce()) {
            return;
        }

        if (!wp_style_is('woocommerce-inline', 'enqueued')) {
            return;
        }

        wp_style_add_data('woocommerce-inline', 'after', '');
    }

    /**
     * Dequeue scripts.
     *
     * @internal Used by `body_class`
     *
     * @param array $classes
     * @return void
     */
    public function dequeueScripts($classes)
    {
        if ($this->isWooCommerce()) {
            return $classes;
        }

        wp_dequeue_script('woocommerce');
        wp_dequeue_script('wc-cart-fragments');
        wp_dequeue_script('wc-add-to-cart');

        return $classes;
    }

    /**
     * Don't show gallery if JS is disabled.
     *
     * @internal Used by `init`
     *
     * @return void
     */
    public function removeGalleryNoscript()
    {
        if ($this->isWooCommerce()) {
            return;
        }
        remove_action('wp_head', 'wc_gallery_noscript');
    }

    /**
     * Disable No JS handling.
     *
     * @internal Used by `body_class`
     *
     * @param array $classes
     * @return void
     */
    public function removeNoJS($classes)
    {
        if ($this->isWooCommerce()) {
            return $classes;
        }

        remove_action('wp_footer', 'wc_no_js');

        return $classes;
    }

    /**
     * Checks whether the current page is a WC page.
     *
     * @return bool
     */
    protected function isWooCommerce()
    {
        return is_woocommerce() || is_cart() || is_checkout();
    }
}
