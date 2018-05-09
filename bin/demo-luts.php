<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Defaults\Defaults;
use Tisd\Lut\PackageIdToPackage as PackageIdToPackageLut;
use Tisd\Lut\ProductCodeIdToPackage as ProductCodeIdToPackageLut;
use Tisd\Lut\ProductCodeToPackage as ProductCodeToPackageLut;
use Tisd\Lut\UuidToPackage as UuidToPackageLut;

/*
$lut = new PackageIdToPackageLut();
dump($lut->getValues());
*/

/*
$options = [
    'locale'  => 'de_DE',
    'context' => Defaults::CONTEXT_MACHINE_VISION,
];
$lut     = new ProductCodeIdToPackageLut($options);
dump($lut->getValues());
*/

/*
$options = [
    'locale'  => 'zh_TW',
    'context' => Defaults::CONTEXT_SCAN2DOCX,
];
$lut     = new ProductCodeToPackageLut($options);
dump($lut->getValues());
*/

/*
$options = [
    'locale'  => 'zh_CN',
    'context' => Defaults::CONTEXT_ASTRONOMY,
];
$lut     = new UuidToPackageLut($options);
dump($lut->getValues());
*/

$options = [
    'locale'  => 'en_US',
    'context' => Defaults::CONTEXT_MICROSCOPY,
];
$lut     = new UuidToPackageLut($options);
//var_dump($lut->getValues());
$lut->getValues();
