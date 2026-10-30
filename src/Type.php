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
        foreach (self::DATA_TYPES as $type) {
            $isType = \sprintf('is_%s', $type);

            if ($isType($value)) {
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
        return match ($type) {
            self::INT => \is_int($value),
            self::BOOL => \is_bool($value),
            self::FLOAT => \is_float($value),
            self::STRING => \is_string($value),
            self::ARRAY => \is_array($value),
            self::OBJECT => \is_object($value),
            self::NULL => $value === null,
            self::NUMERIC => \is_int($value) || \is_float($value),
            'callable' => \is_callable($value),
            'iterable' => \is_iterable($value),
            'resource' => \is_resource($value),
            'countable' => \is_countable($value),
            'scalar' => \is_scalar($value),
            default => (\class_exists($type) || \interface_exists($type)) && $value instanceof $type,
        };
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
        if (!static::is($value, $type)) {
            throw new InvalidTypeException($type, \get_debug_type($value));
        }
    }
}
