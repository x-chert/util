<?php

namespace Xchert\Util\Test;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Xchert\Util\Reflection;
use Xchert\Util\Test\Data\FileDataProvider;

class ReflectionTest extends TestCase
{

    #[DataProviderExternal(FileDataProvider::class, 'reflection_get_property')]
    public function testGetProperty(object $object, string $propertyName, bool $ignoreStatic, bool $found): void
    {
        $property = Reflection::getProperty(new \ReflectionClass($object), $propertyName, $ignoreStatic);

        if ($found === false) {
            $this->assertNull($property);
            return;
        }

        $this->assertSame($propertyName, $property->getName());
    }

    #[DataProviderExternal(FileDataProvider::class, 'reflection_get_properties')]
    public function testGetProperties(object $object, array $expected, bool $ignoreStatic): void
    {
        $properties = Reflection::getProperties(new \ReflectionClass($object), $ignoreStatic);

        $this->assertEqualsCanonicalizing(
            $expected,
            \array_keys($properties)
        );
    }

    #[DataProviderExternal(FileDataProvider::class, 'reflection_get_method')]
    public function testGetMethod(object $object, string $methodName, bool $ignoreStatic, bool $found): void
    {
        $method = Reflection::getMethod(new \ReflectionClass($object), $methodName, $ignoreStatic);

        if ($found === false) {
            $this->assertNull($method);

            return;
        }

        $this->assertEquals($methodName, $method->getName());
    }

    #[DataProviderExternal(FileDataProvider::class, 'reflection_instantiate')]
    public function testInstantiate(string $class, ?object $expected): void
    {
        $object = Reflection::instantiate(new \ReflectionClass($class));

        $this->assertEquals($expected, $object);
    }
}