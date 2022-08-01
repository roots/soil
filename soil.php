<?php

/**
 * Plugin Name:        Soil
 * Plugin URI:         https://roots.io/plugins/soil/
 * Description:        A collection of modules to apply theme-agnostic front-end modifications to WordPress.
 * Version:            4.1.1
 * Author:             Roots
 * Author URI:         https://roots.io/
 * GitHub Plugin URI:  https://github.com/roots/soil
 * Primary Branch:     main
 *
 * License:            MIT License
 * License URI:        https://opensource.org/licenses/MIT
 */

namespace Roots\Soil;

add_action('plugins_loaded', function () {
    if (!class_exists(Soil::class)) {
        require_once file_exists($autoloader = __DIR__ . '/vendor/autoload.php')
            ? $autoloader
            : __DIR__ . '/src/autoload.php';
    }

    $modules = Soil::discoverModules();

    add_action('after_setup_theme', new Soil($modules), 100);
});
