<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk as TisdSdk;

$sdk = new TisdSdk();

$sdk->getCache()->purge();

$sdk->getPackagesByProductCodes(['IC WDM DCAM TIS', 'IC WDM GIGE TIS', 'IC WDM 878 TIS']);

$sdk->getPackagesByProductCodeSearch('IC WDM');
