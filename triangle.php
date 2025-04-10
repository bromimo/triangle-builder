<?php
require_once 'autoload.php';

use TriangleBuilder\TriangleBuilder;

if (
    $argc > 1 &&
    is_numeric($argv[1]) &&
    intval($argv[1]) == $argv[1] &&
    intval($argv[1]) > 0
) {
    $builder = new TriangleBuilder(intval($argv[1]));
    $builder->build();

    /** Или можно так вызвать */

//    TriangleBuilder::make(intval($argv[1]))
//                   ->build();
} else {
    echo 'Введите положительное целое число' . PHP_EOL;
    die;
}