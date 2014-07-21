<?php

include_once __DIR__ . '/init_autoloader.php';

use Tisd\Sdk as Sdk;


$sdk = new Sdk(array('locale' => 'de_DE'));

$sdk->getCache()->purge();

$sdk->getCategoryCount();
$sdk->getSectionCount();
$sdk->getPackageCount();

$sdk->getBuildTime('timestamp');    // or $sdk->getBuildTime();
$sdk->getBuildTime('rtf_2822');
$sdk->getBuildTime('iso_8601');

$sdk->getLocale();
$sdk->getLocales();

$sdk->getPackages();
$sdk->getPackages('downloads');
$sdk->getPackages('downloads', 'enduser');
$sdk->getPackages('downloads', 'enduser', 'iccapture');

$sdk->getPackageByUniqueId('d8f0e8d38af87c120ee5ba34401a4712ae21d7bee3e9bbb70cd9fd301d72b840');
$sdk->getPackageByProductCodeId('iccapture');
$sdk->getPackageByPackageId('iccapture');

$package = $sdk->getPackageByPackageId('footswitch');


echo $package['name']        . PHP_EOL;
echo $package['description'] . PHP_EOL;

foreach ($package['versions'] as $version) {
    echo '- ' . $version['number'] . ' : ' . $version['download']['url'] . PHP_EOL;
}

$sdk->getCache()->purge();
