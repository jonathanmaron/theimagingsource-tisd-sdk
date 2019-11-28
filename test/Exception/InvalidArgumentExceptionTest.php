<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Exception;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Exception\InvalidArgumentException;

class InvalidArgumentExceptionTest extends TestCase
{
    public function testComingSoon(): void
    {
        $this->expectException(InvalidArgumentException::class);

        throw new InvalidArgumentException('random-string', 100);
    }
}
