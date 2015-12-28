<?php

namespace TisdTest\Sdk\Exception;

use PHPUnit_Framework_TestCase;
use Tisd\Sdk\Exception\InvalidArgumentException;

class InvalidArgumentExceptionTest extends PHPUnit_Framework_TestCase
{

    public function testComingSoon()
    {
        $this->setExpectedException('InvalidArgumentException', 'random-string', 100);

        throw new InvalidArgumentException('random-string', 100);
    }
}
