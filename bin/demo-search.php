<?php

require __DIR__ . '/../vendor/autoload.php';


use Tisd\Sdk;

$sdk = new Sdk();

$sdk->getCache()->purge();

$sdk->getPackageByProductCode('IC WDM DCAM TIS');

$sdk->getPackagesByProductCodes(['IC WDM DCAM TIS', 'IC WDM GIGE TIS', 'IC WDM 878 TIS']);

$sdk->getPackagesByProductCodeSearch('IC WDM');
