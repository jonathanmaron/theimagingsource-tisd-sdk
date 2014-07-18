<?php

include_once __DIR__ . '/init_autoloader.php';

use Tisd\Sdk as Sdk;


$sdk = new Sdk(array('locale' => 'de_DE'));

$sdk->getLocale();
$sdk->getLocales();

$sdk->getPackages();
$sdk->getPackages('downloads');
$sdk->getPackages('downloads', 'enduser');
$sdk->getPackages('downloads', 'enduser', 'iccapture');

$sdk->getPackageByUniqueId('9088530fa7e9dcf03ade2118acc662ddab4e614d8069e5979e99dd2be47e6517');
$sdk->getPackageByProductCodeId('iccapture');
$sdk->getPackageByPackageId('iccapture');

$package = $sdk->getPackageByPackageId('footswitch');


echo $package['name']        . PHP_EOL;
echo $package['description'] . PHP_EOL;

foreach ($package['versions'] as $version) {
    echo '- ' . $version['number'] . ' : ' . $version['download']['url'] . PHP_EOL;
}

//$sdk->getCache()->purge();
