<?php

require __DIR__ . '/../vendor/autoload.php';


use Tisd\Sdk;
use Tisd\Sdk\Validator\PackageId     as PackageIdValidator;
use Tisd\Sdk\Validator\ProductCode   as ProductCodeValidator;
use Tisd\Sdk\Validator\ProductCodeId as ProductCodeIdValidator;
use Tisd\Sdk\Validator\UniqueId      as UniqueIdValidator;

$validator = new PackageIdValidator();
var_dump($validator->isValid('icwdm878tis'));

$validator = new ProductCodeIdValidator();
var_dump($validator->isValid('icwdm878tis'));

$validator = new ProductCodeValidator();
var_dump($validator->isValid('IC WDM 878 TIS'));

$validator = new UniqueIdValidator(['locale' => 'de_DE', 'context' => Sdk::CONTEXT_ASTRONOMY]);
var_dump($validator->isValid('6595e5055d'));

$validator = new UniqueIdValidator(['locale' => 'en_US', 'context' => Sdk::CONTEXT_ASTRONOMY]);
var_dump($validator->isValid('6595e5055d'));
