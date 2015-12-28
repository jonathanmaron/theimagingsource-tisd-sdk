<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk as TisdSdk;

$sdk = new TisdSdk(['locale' => 'de_DE']);

$sdk->getCache()->purge();

$sdk->setContext('astronomy');

$packages = $sdk->getPackages();

//var_dump($packages);


$sdk = new TisdSdk(['locale' => 'de_DE']);

$sdk->getCache()->purge();

$sdk->setContext('machinevision');

$packages = $sdk->getPackages('downloads');

var_dump($packages);
