<?php

require_once __DIR__ . '/helpers.php';

spl_autoload_register(function ($className) {
    $relativeClassName = array_slice(explode('\\', $className), 2);
    $file = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $relativeClassName) . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
});
