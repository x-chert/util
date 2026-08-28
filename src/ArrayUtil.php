<?php

namespace Xchert\Util;

class ArrayUtil
{
    public static function ensure(mixed $value): array
    {
        if (\is_array($value)) {
            return $value;
        }

        return $value === null ? [] : [$value];
    }

    public static function iteratorToArray(iterable $iterable): array
    {
        if (\is_array($iterable)) {
            return $iterable;
        }

        $result = [];

        foreach ($iterable as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }

    public static function clone(array $data): array
    {
        $result = [];

        foreach ($data as $index => $value) {
            if (\is_object($value) && !$value instanceof \UnitEnum) {
                $result[$index] = clone $value;

                continue;
            }

            if (\is_array($value)) {
                $result[$index] = static::clone($value);

                continue;
            }

            $result[$index] = $value;
        }

        return $result;
    }
}
