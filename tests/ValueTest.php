<?php

namespace Xchert\Util\Test;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Xchert\Util\Test\Data\FileDataProvider;
use Xchert\Util\Value;

class ValueTest extends TestCase
{
    #[DataProviderExternal(FileDataProvider::class, 'value_is_empty')]
    public function testIsEmpty(mixed $value, bool $expected, bool $considerWhitespacesAsEmpty): void
    {
        $this->assertEquals($expected, Value::isEmpty($value, $considerWhitespacesAsEmpty));
    }

    #[DataProviderExternal(FileDataProvider::class, 'value_is_normalized')]
    public function testIsNormalized(mixed $value, bool $expected): void
    {
        $this->assertEquals($expected, Value::isNormalized($value));

        if (\is_resource($value)) {
            \fclose($value);
        }
    }

    #[DataProviderExternal(FileDataProvider::class, 'value_normalize')]
    public function testNormalize(mixed $value, mixed $expected, ?string $expectedException = null): void
    {
        if ($expectedException !== null) {
            $this->expectException($expectedException);
        }

        try {
            $result = Value::normalize($value);
        } finally {
            if (\is_resource($value)) {
                \fclose($value);
            }
        }

        $this->assertEquals($expected, $result);
    }
}