<?php

include_once __DIR__ . '/common.php';


use Tisd\Sdk as Sdk;


$sdk = new Sdk(array('locale' => 'de_DE'));

$sdk->getCache()->purge();

$sdk->setContext('astronomy');

$packages = $sdk->getPackages();

var_dump($packages);

