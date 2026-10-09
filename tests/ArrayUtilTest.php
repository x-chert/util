<?php

namespace Xchert\Util\Test;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Xchert\Util\ArrayUtil;
use Xchert\Util\Test\Data\FileDataProvider;

class ArrayUtilTest extends TestCase
{
    #[DataProviderExternal(FileDataProvider::class, 'arrayutil_ensure')]
    public function testEnsure(mixed $value, array $expected): void
    {
        $this->assertEquals($expected, ArrayUtil::ensure($value));
    }

    #[DataProviderExternal(FileDataProvider::class, 'arrayutil_iterator_to_array')]
    public function testIteratorToArray(iterable $iterator, array $expected): void
    {
        $this->assertEquals($expected, ArrayUtil::iteratorToArray($iterator));
    }

    #[DataProviderExternal(FileDataProvider::class, 'arrayutil_clone')]
    public function testClone(array $value, array $expected): void
    {
        $this->assertEquals($expected, ArrayUtil::clone($value));
    }
}