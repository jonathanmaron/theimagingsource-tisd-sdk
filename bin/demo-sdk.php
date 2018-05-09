<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk\Sdk;

$sdk = new Sdk([
    'locale' => 'de_DE'
]);

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
$sdk->getPackageByUuid('2b5a907d-5eb0-538b-87ff-1a36bb76c92f');
$sdk->getPackageByProductCodeId('iccapture');
$sdk->getPackageByPackageId('iccapture');

$package = $sdk->getPackageByPackageId('footswitch');

echo $package['name'] . PHP_EOL;
echo $package['abstract'] . PHP_EOL;

foreach ($package['versions'] as $version) {
    echo '- ' . $version['number'] . ' : ' . $version['download']['url'] . PHP_EOL;
}

$sdk->getCache()->purge();

