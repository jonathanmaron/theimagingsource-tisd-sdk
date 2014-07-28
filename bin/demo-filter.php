<?php

include_once __DIR__ . '/../autoload_legacy.php';

use Tisd\Sdk as Sdk;


$sdk = new Sdk(array('locale' => 'de_DE'));

$sdk->getCache()->purge();

$sdk->setFilterByContext('astronomy');

$packages = $sdk->getPackages();

var_dump($packages);

