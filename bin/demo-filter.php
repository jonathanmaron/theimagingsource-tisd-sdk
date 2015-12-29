<?php

require __DIR__ . '/../vendor/autoload.php';


use Tisd\Sdk;

$sdk = new Sdk(['locale' => 'de_DE']);

$sdk->getCache()->purge();

$sdk->setContext('astronomy');

$packages = $sdk->getPackages();

//var_dump($packages);


$sdk = new Sdk(['locale' => 'de_DE']);

$sdk->getCache()->purge();

$sdk->setContext('machinevision');

$packages = $sdk->getPackages('downloads');

var_dump($packages);
