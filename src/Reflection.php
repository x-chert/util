<?php

namespace Xchert\Util;

class Reflection
{
    public static function getProperty(\ReflectionClass $class, string $property, bool $ignoreStatic = true): ?\ReflectionProperty
    {
        if ($class->hasProperty($property)) {
            $p = $class->getProperty($property);

            return (($ignoreStatic && !$p->isStatic()) || !$ignoreStatic) ? $p : null;
        }

        $parentClass = $class->getParentClass();

        return $parentClass !== false ? static::getProperty($parentClass, $property, $ignoreStatic) : null;
    }

    public static function getProperties(\ReflectionClass $class, bool $ignoreStatic = true): array
    {
        $properties = [];

        foreach ($class->getProperties() as $reflectionProperty) {
            if ($ignoreStatic && $reflectionProperty->isStatic()) {
                continue;
            }

            $properties[$reflectionProperty->getName()] = $reflectionProperty;
        }

        $parentClass = $class->getParentClass();

        if ($parentClass instanceof \ReflectionClass) {
            foreach (static::getProperties($parentClass, $ignoreStatic) as $reflectionProperty) {
                if (!isset($properties[$reflectionProperty->getName()])) {
                    $properties[$reflectionProperty->getName()] = $reflectionProperty;
                }
            }
        }

        return $properties;
    }

    public static function getMethod(\ReflectionClass $class, string $method, bool $ignoreStatic = true): ?\ReflectionMethod
    {
        if ($class->hasMethod($method)) {
            $m = $class->getMethod($method);

            return ($ignoreStatic && !$m->isStatic()) || !$ignoreStatic ? $m : null;
        }

        $parentClass = $class->getParentClass();

        return $parentClass !== false ? static::getMethod($parentClass, $method, $ignoreStatic) : null;
    }
}
