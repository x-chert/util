<?php

namespace Xchert\Util;

use Xchert\Util\Exception\InvalidTypeException;

class Type
{
    public const string INT = 'int';

    public const string BOOL = 'bool';

    public const string FLOAT = 'float';

    public const string STRING = 'string';

    public const string ARRAY = 'array';

    public const string OBJECT = 'object';

    public const string NULL = 'null';

    public const string UNKNOWN = 'unknown';

    public const string NUMERIC = 'numeric';

    private const array DATA_TYPES = [
        self::INT,
        self::BOOL,
        self::FLOAT,
        self::STRING,
        self::ARRAY,
        self::OBJECT,
        self::NULL,
    ];

    public static function getType(mixed $value): string
    {
        foreach(self::DATA_TYPES as $type) {
            $isType = \sprintf('is_%s', $type);

            if($isType($value)) {
                return $type;
            }
        }

        return self::UNKNOWN;
    }

    public static function getDebugType(mixed $value): string
    {
        return \get_debug_type($value);
    }

    public static function is(mixed $value, string $type): bool
    {
        if(\class_exists($type) || \interface_exists($type)) {
            return $value instanceof $type;
        }

        $isFunction = \sprintf("is_%s", $type);

        if($type !== self::NUMERIC && \function_exists($isFunction)) {
            return $isFunction($value);
        }

        $valueType = self::getType($value);

        if($type === self::NUMERIC) {
            return self::isNumericType($valueType);
        }

        return $type === $valueType;
    }

    public static function isStringConvertable(string $type): bool
    {
        return \in_array($type, [self::INT, self::BOOL, self::FLOAT, self::STRING, self::NULL]);
    }

    public static function isNumericConvertable(string $type): bool
    {
        return \in_array($type, [self::INT, self::FLOAT, self::STRING, self::BOOL, self::NULL]);
    }

    public static function isNumericType(string $type): bool
    {
        return \in_array($type, [self::INT, self::FLOAT]);
    }

    public static function isScalar(mixed $value): bool
    {
        return \in_array(static::getType($value), [self::INT, self::BOOL, self::FLOAT, self::STRING, self::NULL]);
    }

    /**
     * @throws InvalidTypeException
     */
    public static function validate(mixed $value, string $type): void
    {
        if(!static::is($value, $type)) {
            throw new InvalidTypeException($type, \get_debug_type($value));
        }
    }
}
