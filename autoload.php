<?php

function autoloadMainClasses(string $class_name): void
{
    $class_name = str_replace('\\', '/', $class_name) . '.php';
    $file = __DIR__ . '/'. $class_name;
    if (file_exists($file)) {
        include_once $file;
    }
}
spl_autoload_register('autoloadMainClasses');