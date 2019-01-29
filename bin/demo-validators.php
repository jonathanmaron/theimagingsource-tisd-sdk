<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk\Defaults\Defaults;
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

$validator = new UuidValidator([
    'locale' => 'de_DE',
    'context' => Defaults::CONTEXT_ASTRONOMY
]);
dump($validator->isValid('4f2b81e2-82e2-5a47-a48d-5230971c50de'));

$validator = new UuidValidator([
    'locale' => 'en_US',
    'context' => Defaults::CONTEXT_ASTRONOMY
]);
dump($validator->isValid('efa0ed86-f2ca-5fc1-b895-3cdae849e7a5'));
