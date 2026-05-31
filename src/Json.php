<?php

namespace Xchert\Util;

class Json
{
    /**
     * @throws \JsonException
     */
    public static function encode(mixed $value, int $flags = \JSON_THROW_ON_ERROR | \JSON_INVALID_UTF8_IGNORE | \JSON_UNESCAPED_UNICODE | \JSON_PRESERVE_ZERO_FRACTION, int $depth = 512): string
    {
        return \json_encode($value, $flags, $depth);
    }

    /**
     * @throws \JsonException
     */
    public static function decode(string $value, int $flags = \JSON_THROW_ON_ERROR | \JSON_INVALID_UTF8_IGNORE, int $depth = 512): mixed
    {
        return \json_decode($value, true, $depth, $flags);
    }
}
