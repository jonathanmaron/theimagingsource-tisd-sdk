<?php

include_once __DIR__ . '/common.php';


use Tisd\Sdk as TisdSdk;


$sdk = new TisdSdk(array('locale' => 'de_DE'));

$sdk->getCache()->purge();

$sdk->setContext('astronomy');

$packages = $sdk->getPackages();

var_dump($packages);

