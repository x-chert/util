<?php

namespace Xchert\Util\Test;

use PHPUnit\Framework\TestCase;
use Xchert\Util\Value;

class ValueTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $this->assertTrue(Value::isEmpty(null));
        $this->assertTrue(Value::isEmpty(''));
        $this->assertTrue(Value::isEmpty('   '));
        $this->assertFalse(Value::isEmpty('   ', false));
        $this->assertTrue(Value::isEmpty([]));
        $this->assertFalse(Value::isEmpty([1, 2, 3]));
        $this->assertFalse(Value::isEmpty(0));
        $this->assertFalse(Value::isEmpty('0'));
        $this->assertFalse(Value::isEmpty(123));
        $this->assertFalse(Value::isEmpty(12.34));
        $this->assertTrue(Value::isEmpty(false));
    }

    public function testIsNormalized(): void
    {
        $this->assertTrue(Value::isNormalized(123));
        $this->assertTrue(Value::isNormalized('string'));
        $this->assertTrue(Value::isNormalized(true));
        $this->assertTrue(Value::isNormalized(null));
        $this->assertTrue(Value::isNormalized([1, 'string', true, null]));
        $this->assertFalse(Value::isNormalized([1, 'string', fopen('php://memory', 'r')]));
        $this->assertFalse(Value::isNormalized([1, 'string', new \stdClass()]));
    }

    public function testNormalize(): void
    {
        $this->assertSame(123, Value::normalize(123));
        $this->assertSame('string', Value::normalize('string'));
        $this->assertSame(true, Value::normalize(true));
        $this->assertSame(null, Value::normalize(null));

        $this->assertSame([1, 2, 3], Value::normalize([1, 2, 3]));
        $this->assertSame(['key' => 'value'], Value::normalize(['key' => 'value']));

        $object = new \stdClass();
        $object->key = 'value';
        $normalizedObject = Value::normalize($object);
        $this->assertIsArray($normalizedObject);
        $this->assertArrayHasKey('key', $normalizedObject);
        $this->assertSame('value', $normalizedObject['key']);

        $nestedArray = ['key' => ['nestedKey' => 'nestedValue']];
        $this->assertSame($nestedArray, Value::normalize($nestedArray));

        $this->expectException(\RuntimeException::class);
        Value::normalize(fopen('php://memory', 'r'));
    }
}