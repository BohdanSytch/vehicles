<?php

spl_autoload_register(function ($class_name) {
    $path = __DIR__ ;

    $parts = explode("\\", $class_name);
    $partsLen = count($parts);
    if ($partsLen > 1) {
        for ($i = 0; $i < $partsLen - 1; $i++) {
            $part = strtolower($parts[$i]);
            $path .= '/' . $part;
        }
    }
    $filename = ucfirst($parts[$partsLen - 1]) . '.php';
    $path .= '/' . $filename;

    include $path;
});

define('APP_DIR', __DIR__ . '/');
