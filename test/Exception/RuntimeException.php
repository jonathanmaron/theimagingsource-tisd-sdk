<?php

namespace TisdTest\Sdk\Exception;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Exception\RuntimeException;

class RuntimeExceptionTest extends TestCase
{
    /**
     * @expectedException RuntimeException
     */
    public function testComingSoon()
    {
        throw new RuntimeException('random-string', 100);
    }
}
