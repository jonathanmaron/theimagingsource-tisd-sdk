<?php

namespace TisdTest\Sdk\Exception;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Exception\UnexpectedValueException;

class UnexpectedValueExceptionTest extends TestCase
{
    /**
     * @expectedException UnexpectedValueException
     */
    public function testComingSoon()
    {
        throw new UnexpectedValueException('random-string', 100);
    }
}
