<?php

namespace Xchert\Util\Test;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Xchert\Util\Test\Data\FileDataProvider;
use Xchert\Util\Type;

class TypeTest extends TestCase
{
    #[DataProviderExternal(FileDataProvider::class, 'type_get_type')]
    public function testGetType(mixed $value, string $expected): void
    {
        $this->assertEquals($expected, Type::getType($value));

        if (\is_resource($value)) {
            \fclose($value);
        }
    }

    #[DataProviderExternal(FileDataProvider::class, 'type_is')]
    public function testIs(mixed $value, string $compareType, bool $expected): void
    {
        $this->assertEquals($expected, Type::is($value, $compareType));
    }
}