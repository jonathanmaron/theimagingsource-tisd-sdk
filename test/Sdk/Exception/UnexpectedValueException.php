<?php

namespace TisdTest\Sdk\Exception;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Exception\UnexpectedValueException;

class UnexpectedValueExceptionTest extends PHPUnit_Framework_TestCase
{

    public function testComingSoon()
    {
        $this->setExpectedException('UnexpectedValueException', 'random-string', 100);

        throw new UnexpectedValueException('random-string', 100);
    }
}
