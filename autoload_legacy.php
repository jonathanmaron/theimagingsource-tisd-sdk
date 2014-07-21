<?php

$classmap = include_once __DIR__ . '/autoload_classmap.php';

foreach ($classmap as $filename) {
    include_once $filename;
}