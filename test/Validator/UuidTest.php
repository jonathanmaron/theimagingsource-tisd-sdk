<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Validator;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Validator\Uuid as Validator;

class UuidTest extends TestCase
{
    protected Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    protected function tearDown(): void
    {
        unset($this->validator);
    }

    public function testIsValid(): void
    {
        self::assertFalse($this->validator->isValid('1111111111'));

        self::assertTrue($this->validator->isValid('f6ea27be-096a-509d-84bc-b267f100f0a4'));
    }
}
