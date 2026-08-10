<?php

namespace Xchert\Util\Test;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionProperty;
use Xchert\Util\Reflection;
use Xchert\Util\Test\Classes\ChildDemoClass;
use Xchert\Util\Test\Classes\DemoClass;

class ReflectionTest extends TestCase
{
    public function testGetPropertyReturnsPublicProperty(): void
    {
        $class = new ReflectionClass(new DemoClass());
        $property = Reflection::getProperty($class, 'publicProperty');

        $this->assertInstanceOf(ReflectionProperty::class, $property);
        $this->assertSame('publicProperty', $property->getName());
    }

    public function testGetPropertyIgnoresStaticProperty(): void
    {
        $class = new ReflectionClass(new DemoClass());
        $property = Reflection::getProperty($class, 'staticPublicProperty', true);

        $this->assertNull($property);
    }

    public function testGetPropertyReturnsStaticProperty(): void
    {
        $class = new ReflectionClass(new DemoClass());
        $property = Reflection::getProperty($class, 'staticPublicProperty', false);

        $this->assertInstanceOf(ReflectionProperty::class, $property);
        $this->assertSame('staticPublicProperty', $property->getName());
    }

    public function testGetPropertyReturnsProtectedProperty(): void
    {
        $class = new ReflectionClass(new DemoClass());
        $property = Reflection::getProperty($class, 'protectedProperty');

        $this->assertInstanceOf(ReflectionProperty::class, $property);
        $this->assertSame('protectedProperty', $property->getName());
    }

    public function testGetPropertyReturnsPublicPropertyFromParentClass(): void
    {
        $class = new ReflectionClass(new ChildDemoClass());
        $property = Reflection::getProperty($class, 'publicProperty');

        $this->assertInstanceOf(ReflectionProperty::class, $property);
        $this->assertSame('publicProperty', $property->getName());
    }

    public function testGetPropertyReturnsProtectedPropertyFromParentClass(): void
    {
        $class = new ReflectionClass(new ChildDemoClass());
        $property = Reflection::getProperty($class, 'protectedProperty');

        $this->assertInstanceOf(ReflectionProperty::class, $property);
        $this->assertSame('protectedProperty', $property->getName());
    }

    public function testGetPropertyReturnsPrivatePropertyFromParentClass(): void
    {
        $class = new ReflectionClass(new ChildDemoClass());
        $property = Reflection::getProperty($class, 'privateProperty');

        $this->assertInstanceOf(ReflectionProperty::class, $property);
        $this->assertSame('privateProperty', $property->getName());
    }

    public function testGetPropertyReturnsNullForNonExistentProperty(): void
    {
        $class = new ReflectionClass(new DemoClass());
        $property = Reflection::getProperty($class, 'nonExistentProperty');

        $this->assertNull($property);
    }

    public function testGetPropertiesFindsAllProperties(): void
    {
        $class = new ReflectionClass(new DemoClass());
        $properties = Reflection::getProperties($class);

        $this->assertEquals(
            [
                'publicProperty',
                'protectedProperty',
                'privateProperty',
            ],
            \array_keys($properties)
        );
    }

    public function testGetPropertiesFindsAllPropertiesIncludingParent(): void
    {
        $class = new ReflectionClass(new ChildDemoClass());
        $properties = Reflection::getProperties($class);

        $this->assertEquals(
            [
                'childPublicProperty',
                'childProtectedProperty',
                'childPrivateProperty',
                'publicProperty',
                'protectedProperty',
                'privateProperty',
            ],
            \array_keys($properties)
        );
    }

    public function testGetPropertiesFindsAllPropertiesIncludingStatic(): void
    {
        $class = new ReflectionClass(new DemoClass());
        $properties = Reflection::getProperties($class, false);

        $this->assertEquals(
            [
                'staticPublicProperty',
                'staticProtectedProperty',
                'publicProperty',
                'protectedProperty',
                'privateProperty',
            ],
            \array_keys($properties)
        );
    }

    public function testGetPropertiesFindsAllPropertiesIncludingParentAndStatic(): void
    {
        $class = new ReflectionClass(new ChildDemoClass());
        $properties = Reflection::getProperties($class, false);

        $this->assertEquals(
            [
                'childPublicProperty',
                'childProtectedProperty',
                'childPrivateProperty',
                'staticPublicProperty',
                'staticProtectedProperty',
                'publicProperty',
                'protectedProperty',
                'privateProperty',
            ],
            \array_keys($properties)
        );
    }

    public function testGetMethodReturnsPublicMethod(): void
    {
        $class = new ReflectionClass(new DemoClass());
        $method = Reflection::getMethod($class, 'publicMethod');

        $this->assertNotNull($method);
        $this->assertEquals('publicMethod', $method->getName());
    }

    public function testGetMethodReturnsProtectedMethod(): void
    {
        $class = new ReflectionClass(new DemoClass());
        $method = Reflection::getMethod($class, 'protectedMethod');

        $this->assertNotNull($method);
        $this->assertEquals('protectedMethod', $method->getName());
    }

    public function testGetMethodReturnsPrivateMethod(): void
    {
        $class = new ReflectionClass(new DemoClass());
        $method = Reflection::getMethod($class, 'privateMethod');

        $this->assertNotNull($method);
        $this->assertEquals('privateMethod', $method->getName());
    }

    public function testGetMethodReturnsParentPublicMethod(): void
    {
        $class = new ReflectionClass(new ChildDemoClass());
        $method = Reflection::getMethod($class, 'publicMethod');

        $this->assertNotNull($method);
        $this->assertEquals('publicMethod', $method->getName());
    }

    public function testGetMethodReturnsParentProtectedMethod(): void
    {
        $class = new ReflectionClass(new ChildDemoClass());
        $method = Reflection::getMethod($class, 'protectedMethod');

        $this->assertNotNull($method);
        $this->assertEquals('protectedMethod', $method->getName());
    }

    public function testGetMethodReturnsParentPrivateMethod(): void
    {
        $class = new ReflectionClass(new ChildDemoClass());
        $method = Reflection::getMethod($class, 'privateMethod');

        $this->assertNotNull($method);
        $this->assertEquals('privateMethod', $method->getName());
    }
}