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

    public static function readFile(string $file): iterable
    {
        if (!\file_exists($file) || !\is_readable($file)) {
            throw new \RuntimeException(\sprintf('File %s does not exist or is not readable.', $file));
        }

        return require $file;
    }
}