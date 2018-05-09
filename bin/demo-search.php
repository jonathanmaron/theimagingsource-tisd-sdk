<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk\Sdk;

$sdk = new Sdk([
    'locale' => 'zh_CN'
]);

$sdk->getCache()->purge();

$package = $sdk->getPackageByProductCode('IC WDM DCAM TIS');
dump($package);

$packages = $sdk->getPackagesByProductCodes([
    'IC WDM DCAM TIS',
    'IC WDM GIGE TIS',
    'IC WDM 878 TIS'
]);
dump($packages);

$sdk->getPackagesByProductCodeSearch('IC WDM');

$sdk->getCache()->purge();
