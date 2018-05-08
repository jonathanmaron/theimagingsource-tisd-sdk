<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk;

$sdk = new Sdk(['locale' => 'de_DE']);

//$sdk->getCache()->purge();

$sdk->setContext('astronomy');

$packages = $sdk->getPackages('downloads');

dump($packages);

exit();


$sdk->getCache()->purge();


$sdk = new Sdk(['locale' => 'de_DE']);

$sdk->getCache()->purge();

$sdk->setContext('machinevision');

$packages = $sdk->getPackages('downloads');

dump($packages);

$sdk->getCache()->purge();
