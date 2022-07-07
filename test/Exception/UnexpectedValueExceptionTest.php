<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Exception;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Exception\UnexpectedValueException;

class UnexpectedValueExceptionTest extends TestCase
{
    public function testComingSoon(): void
    {
        $this->expectException(UnexpectedValueException::class);

        throw new UnexpectedValueException('random-string', 100);
    }
}
