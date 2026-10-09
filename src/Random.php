<?php

declare(strict_types=1);

namespace Xchert\Util;

use Random\RandomException;

class Random
{
    public const string DEFAULT_CHARLIST = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public const string ALPHANUMERIC_CHARLIST = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * @throws RandomException
     * @throws \InvalidArgumentException
     */
    public static function bytes(int $length): string
    {
        if ($length < 1) {
            throw new \InvalidArgumentException('Length must be greater than zero.');
        }

        return \random_bytes($length);
    }

    /**
     * @throws RandomException
     */
    public static function boolean(): bool
    {
        $byte = static::bytes(1);

        return (bool)(\ord($byte) % 2);
    }

    /**
     * @throws RandomException
     * @throws \LogicException
     */
    public static function integer(int $min, int $max): int
    {
        if ($min > $max) {
            throw new \LogicException('Min must not be greater than max.');
        }

        return \random_int($min, $max);
    }

    /**
     * @throws RandomException
     * @throws \InvalidArgumentException
     */
    public static function string(int $length, string $charlist = self::DEFAULT_CHARLIST): string
    {
        if ($length < 1) {
            throw new \InvalidArgumentException('Length must be greater than zero.');
        }

        $randomString = '';
        $charLength = \strlen($charlist);

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $charlist[static::integer(0, $charLength - 1)];
        }

        return $randomString;
    }

    /**
     * @throws RandomException
     * @throws \InvalidArgumentException
     */
    public static function alphanumericString(int $length): string
    {
        return static::string($length, self::ALPHANUMERIC_CHARLIST);
    }
}