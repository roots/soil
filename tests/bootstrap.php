<?php

if (version_compare(phpversion(), '7.1', '<')) {
    require __DIR__ . '/TestCase56.php';
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/api.php';
require __DIR__ . '/helpers.php';
