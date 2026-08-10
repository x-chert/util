<?php

namespace Xchert\Util\Test;

use PHPUnit\Framework\TestCase;
use Xchert\Util\Type;

class TypeTest extends TestCase
{
    public function testGetType(): void
    {
        $this->assertSame(Type::INT, Type::getType(123));
        $this->assertSame(Type::BOOL, Type::getType(true));
        $this->assertSame(Type::BOOL, Type::getType(false));
        $this->assertSame(Type::FLOAT, Type::getType(123.45));
        $this->assertSame(Type::STRING, Type::getType("hello"));
        $this->assertSame(Type::ARRAY, Type::getType([1, 2, 3]));
        $this->assertSame(Type::OBJECT, Type::getType(new \stdClass()));
        $this->assertSame(Type::NULL, Type::getType(null));
    }

    public function testGetTypeWithUnknown(): void
    {
        $resource = \fopen('php://memory', 'r');
        $this->assertSame(Type::UNKNOWN, Type::getType($resource));
        \fclose($resource);
    }

    public function testIsWithValidTypes(): void
    {
        $this->assertTrue(Type::is(123, Type::INT));
        $this->assertTrue(Type::is(true, Type::BOOL));
        $this->assertTrue(Type::is(123.45, Type::FLOAT));
        $this->assertTrue(Type::is("hello", Type::STRING));
        $this->assertTrue(Type::is([1, 2, 3], Type::ARRAY));
        $this->assertTrue(Type::is(new \stdClass(), \stdClass::class));
        $this->assertFalse(Type::is(new \stdClass(), 'NonExistentClass'));
        $this->assertTrue(Type::is([], 'array'));
        $this->assertFalse(Type::is(123, 'nonexistent_type'));
        $this->assertFalse(Type::is(null, Type::BOOL));
    }
}