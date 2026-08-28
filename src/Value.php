<?php

namespace Xchert\Util;

class Value
{
    public static function isNormalized(mixed $value): bool
    {
        if (Type::isScalar($value)) {
            return true;
        }

        if (\is_array($value)) {
            foreach ($value as $v) {
                if (!static::isNormalized($v)) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

    public static function isEmpty(mixed $value, bool $considerWhitespacesAsEmpty = true): bool
    {
        if (\is_string($value) && $considerWhitespacesAsEmpty) {
            $value = \trim($value);
        }

        if (!empty($value)) {
            return false;
        }

        return !\is_numeric($value);
    }

    public static function normalize(mixed $value): mixed
    {
        try {
            return Json::decode(Json::encode($value));
        } catch (\JsonException $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
