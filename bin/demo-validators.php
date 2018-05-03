<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Defaults;
use Tisd\Sdk\Validator\PackageId as PackageIdValidator;
use Tisd\Sdk\Validator\ProductCode as ProductCodeValidator;
use Tisd\Sdk\Validator\ProductCodeId as ProductCodeIdValidator;
use Tisd\Sdk\Validator\Uuid as UuidValidator;

$validator = new PackageIdValidator();
dump($validator->isValid('icwdm878tis'));

$validator = new ProductCodeIdValidator();
dump($validator->isValid('icwdm878tis'));

$validator = new ProductCodeValidator();
dump($validator->isValid('IC WDM 878 TIS'));

$validator = new UuidValidator(['locale' => 'de_DE', 'context' => Defaults::CONTEXT_ASTRONOMY]);
dump($validator->isValid('4198ecea-7436-5875-94d4-bbb378ba6110'));

$validator = new UuidValidator(['locale' => 'en_US', 'context' => Defaults::CONTEXT_ASTRONOMY]);
dump($validator->isValid('4198ecea-7436-5875-94d4-bbb378ba6110'));
