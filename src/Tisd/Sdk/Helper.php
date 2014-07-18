<?php

namespace Tisd\Sdk;

use Tisd\Sdk as TisdSdk;


class Helper
{

    protected static function getInstance($options)
    {
        return new TisdSdk($options);
    }

    public static function getPackageByProductCodeId($productCodeId, $options = array())
    {
        return self::getInstance($options)->getPackageByProductCodeId($productCodeId);
    }

    public static function getPackageByPackageId($packageId, $options = array())
    {
        return self::getInstance($options)->getPackageByPackageId($packageId);
    }

    public static function getPackageByUniqueId($uniqueId, $options = array())
    {
        return self::getInstance($options)->getPackageByUniqueId($uniqueId);
    }

    public static function getPackages($categoryId = null, $sectionId = null, $packageId = null, $options = array())
    {
        return self::getInstance($options)->getPackages($categoryId, $sectionId, $packageId);
    }

    public static function getCache($options = array())
    {
        return self::getInstance($options)->getCache();
    }

}