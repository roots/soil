<?php

namespace Roots\Soil\Tests;

function plugin_entrypoint()
{
    return __DIR__ . '/../soil.php';
}

function fixture($fixture)
{
    return __DIR__ . '/__fixtures__/' . $fixture;
}
