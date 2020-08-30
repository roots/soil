<?php

namespace Roots\Soil\Modules;

use Roots\Soil\NavWalker;

/**
 * Cleaner walker for wp_nav_menu()
 */
class NavWalkerModule extends AbstractModule
{
    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name = 'nav-walker';

    /**
     * Module handle.
     *
     * @return void
     */
    public function handle()
    {
        $this->filter('wp_nav_menu_args', 'navMenu');
    }

    /**
     * Clean up wp_nav_menu_args
     *
     * Remove the container
     * Remove the id="" on nav menu items
     */
    public function navMenu($args = [])
    {
        $nav_menu_args = [];
        $nav_menu_args['container'] = false;

        if (!$args['items_wrap']) {
            $nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
        }

        if (!$args['walker']) {
            $nav_menu_args['walker'] = new NavWalker();
        }

        return array_merge($args, $nav_menu_args);
    }
}
