<?php

namespace Tisd\Sdk\Defaults;

abstract class AbstractDefaults
{
    public const CONTEXT_ASTRONOMY      = 'astronomy';

    public const CONTEXT_MACHINE_VISION = 'machinevision';

    public const CONTEXT_MICROSCOPY     = 'microscopy';

    public const CONTEXT_SCAN2DOCX      = 'scan2docx';

    public const CONTEXT_SCAN2VOICE     = 'scan2voice';

    public const HOSTNAME_DEVELOPMENT   = 'dl.theimagingsource.com.development';

    public const HOSTNAME_PRODUCTION    = 'dl.theimagingsource.com';

    public const LOCALE                 = 'en_US';

    public const TIMEOUT                = 25;

    public const VERSION                = '2.5';

    protected static $context;

    protected static $hostname;

    protected static $locale;

    protected static $timeout;

    protected static $version;
}
