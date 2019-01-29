<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk\Defaults\Defaults;
use Tisd\Sdk\Lut\PackageIdToPackage as PackageIdToPackageLut;
use Tisd\Sdk\Lut\ProductCodeIdToPackage as ProductCodeIdToPackageLut;
use Tisd\Sdk\Lut\ProductCodeToPackage as ProductCodeToPackageLut;
use Tisd\Sdk\Lut\UuidToPackage as UuidToPackageLut;

$lut = new PackageIdToPackageLut();
dump($lut->getValues());

$options = [
    'locale'  => 'de_DE',
    'context' => Defaults::CONTEXT_MACHINE_VISION,
];
$lut     = new ProductCodeIdToPackageLut($options);
dump($lut->getValues());

$options = [
    'locale'  => 'zh_TW',
    'context' => Defaults::CONTEXT_SCAN2DOCX,
];
$lut     = new ProductCodeToPackageLut($options);
dump($lut->getValues());

$options = [
    'locale'  => 'zh_CN',
    'context' => Defaults::CONTEXT_ASTRONOMY,
];
$lut     = new UuidToPackageLut($options);
dump($lut->getValues());

$options = [
    'locale'  => 'en_US',
    'context' => Defaults::CONTEXT_MICROSCOPY,
];
$lut     = new UuidToPackageLut($options);
dump($lut->getValues());
