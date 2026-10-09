<?php

namespace Xchert\Util\Test;

use PHPUnit\Framework\TestCase;
use Xchert\Util\ArrayUtil;
use Xchert\Util\Test\Classes\DemoEnum;

class ArrayUtilTest extends TestCase
{
    public function testEnsureReturnsEmptyArrayForNull()
    {
        $result = ArrayUtil::ensure(null);
        $this->assertSame([], $result);
    }

    public function testEnsureReturnsSameArrayForArrayInput()
    {
        $input = [1, 2, 3];
        $result = ArrayUtil::ensure($input);
        $this->assertSame($input, $result);
    }

    public function testEnsureWrapsScalarValueIntoArray()
    {
        $result = ArrayUtil::ensure(42);
        $this->assertSame([42], $result);
    }

    public function testEnsureWrapsObjectIntoArray()
    {
        $object = new \stdClass();
        $result = ArrayUtil::ensure($object);
        $this->assertSame([$object], $result);
    }

    public function testIteratorToArrayConvertsGeneratorToArray()
    {
        $iterable = (function () {
            yield 'key1' => 'value1';
            yield 'key2' => 'value2';
        })();

        $result = ArrayUtil::iteratorToArray($iterable);

        $this->assertSame(['key1' => 'value1', 'key2' => 'value2'], $result);
    }

    public function testIteratorToArrayReturnsSameArrayForArrayInput()
    {
        $input = ['foo' => 'bar', 'baz' => 'qux'];

        $result = ArrayUtil::iteratorToArray($input);

        $this->assertSame($input, $result);
    }

    public function testIteratorToArrayConvertsArrayIteratorToArray()
    {
        $iterable = new \ArrayIterator(['key1' => 'value1', 'key2' => 'value2']);

        $result = ArrayUtil::iteratorToArray($iterable);

        $this->assertSame(['key1' => 'value1', 'key2' => 'value2'], $result);
    }

    public function testCloneCreatesDeepCopyOfObjectsInArray()
    {
        $object1 = new \stdClass();
        $object1->property = 'value';

        $array = [$object1];
        $result = ArrayUtil::clone($array);

        $this->assertEquals($array, $result);
        $this->assertNotSame($array, $result);

        $this->assertNotSame($object1, $result[0]);
        $this->assertEquals($object1, $result[0]);
    }

    public function testCloneCreatesDeepCopyOfNestedArrays()
    {
        $array = [
            'level1' => [
                'level2' => [
                    'level3' => 'value'
                ]
            ]
        ];

        $result = ArrayUtil::clone($array);

        $this->assertEquals($array, $result);
    }

    public function testClonePreservesUnitEnumInstanceReferences()
    {
        $enumInstance = DemoEnum::A;

        $array = ['enum' => $enumInstance];
        $result = ArrayUtil::clone($array);

        $this->assertSame($enumInstance, $result['enum']);
    }
}