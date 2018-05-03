<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Defaults;
use Tisd\Sdk\Lut\PackageIdToPackage as PackageIdToPackageLut;
use Tisd\Sdk\Lut\ProductCodeIdToPackage as ProductCodeIdToPackageLut;
use Tisd\Sdk\Lut\ProductCodeToPackage as ProductCodeToPackageLut;
use Tisd\Sdk\Lut\UuidToPackage as UuidToPackageLut;

$lut = new PackageIdToPackageLut();
dump($lut->getValues());

$lut = new ProductCodeIdToPackageLut(['locale' => 'de_DE', 'context' => Defaults::CONTEXT_MACHINE_VISION]);
dump($lut->getValues());

$lut = new ProductCodeToPackageLut(['locale' => 'zh_TW', 'context' => Defaults::CONTEXT_SCAN2DOCX]);
dump($lut->getValues());

$lut = new UuidToPackageLut(['locale' => 'zh_CN', 'context' => Defaults::CONTEXT_ASTRONOMY]);
dump($lut->getValues());

$lut = new UuidToPackageLut(['locale' => 'en_US', 'context' => Defaults::CONTEXT_MICROSCOPY]);
dump($lut->getValues());
