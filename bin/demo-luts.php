<?php

require __DIR__ . '/../vendor/autoload.php';


use Tisd\Sdk;
use Tisd\Sdk\Lut\PackageIdToPackage     as PackageIdToPackageLut;
use Tisd\Sdk\Lut\ProductCodeIdToPackage as ProductCodeIdToPackageLut;
use Tisd\Sdk\Lut\ProductCodeToPackage   as ProductCodeToPackageLut;
use Tisd\Sdk\Lut\UniqueIdToPackage      as UniqueIdToPackageLut;

$lut = new PackageIdToPackageLut();
var_dump($lut->getValues());

$lut = new ProductCodeIdToPackageLut(['locale' => 'de_DE', 'context' => Sdk::CONTEXT_MACHINE_VISION]);
var_dump($lut->getValues());

$lut = new ProductCodeToPackageLut(['locale' => 'fr_FR', 'context' => Sdk::CONTEXT_SCAN2DOCX]);
var_dump($lut->getValues());

$lut = new UniqueIdToPackageLut(['locale' => 'zh_CN', 'context' => Sdk::CONTEXT_ASTRONOMY]);
var_dump($lut->getValues());
