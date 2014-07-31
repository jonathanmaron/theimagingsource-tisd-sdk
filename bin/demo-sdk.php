<?php

include_once __DIR__ . '/common.php';


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

$sdk->getContexts();

$sdk->getPackages();
$sdk->getPackages('downloads');
$sdk->getPackages('downloads', 'enduser');
$sdk->getPackages('downloads', 'enduser', 'iccapture');
$sdk->getPackagesByProductCodes(array('IC WDM 1394b TIS', 'ICPresenter', 'Scan2Docx OCR'));

$sdk->getPackageByProductCode('SKYRIS FW');
$sdk->getPackageByUniqueId('69a5d3c60f');
$sdk->getPackageByProductCodeId('iccapture');
$sdk->getPackageByPackageId('iccapture');

$sdk->getUniqueIdToPackageLut();
$sdk->getProductCodeIdToPackageLut();
$sdk->getPackageIdToPackageLut();


$package = $sdk->getPackageByPackageId('footswitch');

echo $package['name']     . PHP_EOL;
echo $package['abstract'] . PHP_EOL;

foreach ($package['versions'] as $version) {
    echo '- ' . $version['number'] . ' : ' . $version['download']['url'] . PHP_EOL;
}

//$sdk->getCache()->purge();
