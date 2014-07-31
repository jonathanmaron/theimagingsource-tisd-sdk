<?php

include_once __DIR__ . '/common.php';


use Tisd\Sdk as TisdSdk;

use Tisd\Sdk\Lut\PackageIdToPackage     as PackageIdToPackageLut;
use Tisd\Sdk\Lut\ProductCodeIdToPackage as ProductCodeIdToPackageLut;
use Tisd\Sdk\Lut\ProductCodeToPackage   as ProductCodeToPackageLut;
use Tisd\Sdk\Lut\UniqueIdToPackage      as UniqueIdToPackageLut;


$lut = new PackageIdToPackageLut();
var_dump($lut->getValues());

$lut = new ProductCodeIdToPackageLut(array('locale' => 'de_DE', 'context' => TisdSdk::CONTEXT_MACHINE_VISION));
var_dump($lut->getValues());

$lut = new ProductCodeToPackageLut(array('locale' => 'fr_FR', 'context' => TisdSdk::CONTEXT_SCAN2DOCX));
var_dump($lut->getValues());

$lut = new UniqueIdToPackageLut(array('locale' => 'zh_CN', 'context' => TisdSdk::CONTEXT_ASTRONOMY));
var_dump($lut->getValues());
