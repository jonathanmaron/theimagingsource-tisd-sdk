<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Exception;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Exception\InvalidArgumentException;

class InvalidArgumentExceptionTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testComingSoon(): void
    {
        throw new InvalidArgumentException('random-string', 100);
    }
}
