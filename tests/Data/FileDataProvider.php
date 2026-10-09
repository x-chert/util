<?php

declare(strict_types=1);

namespace Xchert\Util\Test\Data;

class FileDataProvider
{
    public static function value_is_empty(): iterable
    {
        return static::readFile(__DIR__.'/value_is_empty.php');
    }

    public static function value_is_normalized(): iterable
    {
        return static::readFile(__DIR__.'/value_is_normalized.php');
    }

    public static function value_normalize(): iterable
    {
        return static::readFile(__DIR__.'/value_normalize.php');
    }

    public static function type_get_type(): iterable
    {
        return static::readFile(__DIR__.'/type_get_type.php');
    }

    public static function type_is(): iterable
    {
        return static::readFile(__DIR__.'/type_is.php');
    }

    public static function arrayutil_ensure(): iterable
    {
        return static::readFile(__DIR__.'/arrayutil_ensure.php');
    }

    public static function arrayutil_iterator_to_array(): iterable
    {
        return static::readFile(__DIR__.'/arrayutil_iterator_to_array.php');
    }

    public static function arrayutil_clone(): iterable
    {
        return static::readFile(__DIR__.'/arrayutil_clone.php');
    }

    public static function reflection_get_property(): iterable
    {
        return static::readFile(__DIR__.'/reflection_get_property.php');
    }

    public static function reflection_get_properties(): iterable
    {
        return static::readFile(__DIR__.'/reflection_get_properties.php');
    }

    public static function reflection_get_method(): iterable
    {
        return static::readFile(__DIR__.'/reflection_get_method.php');
    }

    public static function reflection_instantiate(): iterable
    {
        return static::readFile(__DIR__.'/reflection_instantiate.php');
    }

    public static function readFile(string $file): iterable
    {
        if (!\file_exists($file) || !\is_readable($file)) {
            throw new \RuntimeException(\sprintf('File %s does not exist or is not readable.', $file));
        }

        return require $file;
    }
}