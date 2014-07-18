<?php

$map = include __DIR__ . '/../autoload_classmap.php';

foreach ($map as $filename) {
    include_once $filename;
}