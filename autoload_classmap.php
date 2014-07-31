<?php

return array(

    'Tisd\Sdk'                                    => __DIR__ . '/src/Tisd/Sdk.php',

    'Tisd\Sdk\Cache'                              => __DIR__ . '/src/Tisd/Sdk/Cache.php',

    'Tisd\Sdk\Lut\AbstractLut'                    => __DIR__ . '/src/Tisd/Sdk/Lut/AbstractLut.php',
    'Tisd\Sdk\Lut\PackageIdToPackage'             => __DIR__ . '/src/Tisd/Sdk/Lut/PackageIdToPackage.php',
    'Tisd\Sdk\Lut\ProductCodeIdToPackage'         => __DIR__ . '/src/Tisd/Sdk/Lut/ProductCodeIdToPackage.php',
    'Tisd\Sdk\Lut\ProductCodeToPackage'           => __DIR__ . '/src/Tisd/Sdk/Lut/ProductCodeToPackage.php',
    'Tisd\Sdk\Lut\UniqueIdToPackage'              => __DIR__ . '/src/Tisd/Sdk/Lut/UniqueIdToPackage.php',

    'Tisd\Sdk\Validator\AbstractValidator'        => __DIR__ . '/src/Tisd/Sdk/Validator/AbstractValidator.php',
    'Tisd\Sdk\Validator\PackageId'                => __DIR__ . '/src/Tisd/Sdk/Validator/PackageId.php',
    'Tisd\Sdk\Validator\ProductCodeId'            => __DIR__ . '/src/Tisd/Sdk/Validator/ProductCodeId.php',
    'Tisd\Sdk\Validator\ProductCode'              => __DIR__ . '/src/Tisd/Sdk/Validator/ProductCode.php',
    'Tisd\Sdk\Validator\UniqueId'                 => __DIR__ . '/src/Tisd/Sdk/Validator/UniqueId.php',

    'Tisd\Sdk\Exception\ExceptionInterface'       => __DIR__ . '/src/Tisd/Sdk/Exception/ExceptionInterface.php',
    'Tisd\Sdk\Exception\InvalidArgumentException' => __DIR__ . '/src/Tisd/Sdk/Exception/InvalidArgumentException.php',
    'Tisd\Sdk\Exception\RuntimeException'         => __DIR__ . '/src/Tisd/Sdk/Exception/RuntimeException.php',

);