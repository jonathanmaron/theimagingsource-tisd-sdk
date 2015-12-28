<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk as TisdSdk;

$sdk = new TisdSdk(['locale' => 'de_DE']);

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
$sdk->getPackagesByProductCodes(['IC WDM 1394b TIS', 'ICPresenter', 'Scan2Docx OCR']);

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

