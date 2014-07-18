<?php

$classMap       = include __DIR__ . '/../autoload_classmap.php';
$classFilenames = array_values($classMap);

foreach ($classFilenames as $classFilename) {
    include_once $classFilename;
}