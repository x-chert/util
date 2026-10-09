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

    /**
     * @throws \ReflectionException
     */
    public static function instantiate(\ReflectionClass $class): object
    {
        $constructor = $class->getConstructor();

        if ($constructor === null) {
            return $class->newInstance();
        }

        $params = static::getDefaultParameters($constructor);

        if ($params !== null) {
            return $class->newInstanceArgs($params);
        }

        return $class->newInstanceWithoutConstructor();
    }

    /**
     * @throws \ReflectionException
     */
    public static function getDefaultParameters(\ReflectionMethod $method): ?array
    {
        $params = [];

        /** @var \ReflectionParameter $parameter */
        foreach ($method->getParameters() as $parameter) {
            if ($parameter->isOptional()) {
                $params[$parameter->getName()] = $parameter->getDefaultValue();

                continue;
            }

            if ($parameter->allowsNull()) {
                $params[$parameter->getName()] = null;

                continue;
            }

            // If any parameter is not optional and not nullable, default parameters are not available
            return null;
        }

        return $params;
    }
}
