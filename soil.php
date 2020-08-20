<?php

/**
 * Plugin Name:        Soil
 * Plugin URI:         https://roots.io/plugins/soil/
 * Description:        A collection of modules to apply theme-agnostic front-end modifications to WordPress.
 * Version:            4.0.0-alpha.0
 * Author:             Roots
 * Author URI:         https://roots.io/
 * GitHub Plugin URI:  https://github.com/roots/soil
 *
 * License:            MIT License
 * License URI:        https://opensource.org/licenses/MIT
 */

namespace Roots\Soil;

require_once __DIR__ . '/vendor/autoload.php';

add_action('plugins_loaded', function () {
    $modules = Soil::discoverModules();

    add_action('after_setup_theme', new Soil($modules), 100);
});
