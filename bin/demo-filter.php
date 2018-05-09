<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk\Sdk;
use Tisd\Sdk\Defaults\Defaults;

$sdk = new Sdk([
    'locale' => 'de_DE'
]);

$sdk->setContext(Defaults::CONTEXT_ASTRONOMY);

$packages = $sdk->getPackages('downloads');

dump($packages);

$sdk->getCache()->purge();


$sdk = new Sdk([
    'locale' => 'de_DE'
]);

$sdk->getCache()->purge();

$sdk->setContext('machinevision');

$packages = $sdk->getPackages('downloads');

dump($packages);

$sdk->getCache()->purge();
