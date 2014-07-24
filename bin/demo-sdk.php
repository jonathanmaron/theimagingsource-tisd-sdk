<?php

include_once __DIR__ . '/../autoload_legacy.php';

use Tisd\Sdk as Sdk;


$sdk = new Sdk(array('locale' => 'de_DE'));

//$sdk->getCache()->purge();


//var_dump( $sdk->getUniqueIdToPackageLut() );
var_dump( $sdk->getProductCodeIdToPackageLut() );
//var_dump( $sdk->getPackageIdToPackageLut() );

exit();

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

$sdk->getPackageByUniqueId('69a5d3c60f');
$sdk->getPackageByProductCodeId('iccapture');
$sdk->getPackageByPackageId('iccapture');

$package = $sdk->getPackageByPackageId('footswitch');


echo $package['name']        . PHP_EOL;
echo $package['description'] . PHP_EOL;

foreach ($package['versions'] as $version) {
    echo '- ' . $version['number'] . ' : ' . $version['download']['url'] . PHP_EOL;
}

//$sdk->getCache()->purge();
