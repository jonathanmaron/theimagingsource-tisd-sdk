<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk;
use Tisd\Defaults;

$sdk = new Sdk(['locale' => 'de_DE', 'hostname' => Defaults::HOSTNAME_DEVELOPMENT]);

//$package = $sdk->getPackageByUuid('9545f254-c7d4-54a4-a86b-c9e367bf4c57');
//$package = $sdk->getPackageByProductCodeId('fsdfk27bup006');
//$package = $sdk->getPackageByPackageId('fsdfk27bup006');
//$package = $sdk->getPackageByProductCode('FS/DFK 27BUP006');

//dump($sdk->getMeta());
//dump($sdk->getCategoryCount());
//dump($sdk->getSectionCount());
//dump($sdk->getPackageCount());
//dump($sdk->getBuildTime());
//dump($sdk->getLocales());
//dump($sdk->getContexts());

/*
$packages = $sdk->getPackagesByProductCodes([
    'IC WDM UVCCAM TIS',
    'ICX445AQA',
    'FS/DMK 41BF02.H',
    'MN/IC Imaging Control .NET',
]);
*/

$sdk->getCache()->purge();

dump($sdk->getLocales());

