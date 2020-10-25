<?php

use Roots\Soil\Tests\TestCaseLegacy;

if (version_compare(phpversion(), '7.1', '<')) {
    class_alias(TestCaseLegacy::class, 'Roots\Soil\Tests\TestCase');
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/api.php';
require __DIR__ . '/helpers.php';
