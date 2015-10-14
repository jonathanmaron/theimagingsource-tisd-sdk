<?php

include_once __DIR__ . '/common.php';

use Tisd\Sdk as TisdSdk;

$sdk = new TisdSdk();

$sdk->setContext('machinevision');



$packages = $sdk->getPackages('downloads');

var_dump($packages);

