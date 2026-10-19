<?php

namespace Xchert\Util\Pod;

use Xchert\Util\ArrayUtil;
use Xchert\Util\Reflection;

class Pod implements \JsonSerializable
{
    /** @var array<class-string, array<string, true>> */
    private static array $propertyCache = [];

    public static function from(Pod $pod): static
    {
        try {
            $self = (new \ReflectionClass(static::class))
                ->newInstanceWithoutConstructor();
        } catch (\ReflectionException $e) {
            throw new \RuntimeException($e->getMessage());
        }

        $self->allocate($pod->toArray());

        return $self;
    }

    public function allocate(array $data): void
    {
        $this->_loadPropertyCache();

        $properties = self::$propertyCache[static::class];

        foreach ($data as $key => $value) {
            if (isset($properties[$key])) {
                try {
                    $this->$key = $value;
                } catch (\Throwable $error) {
                    // do nothing
                }
            }
        }
    }

    public function jsonSerialize(): array
    {
        $data = $this->toArray();

        foreach ($data as &$value) {
            if ($value instanceof \DateTimeInterface) {
                $value = $value->format(\DateTimeInterface::RFC3339_EXTENDED);
            }
        }

        return $data;
    }

    public function toArray(): array
    {
        $this->_loadPropertyCache();

        $data = \get_object_vars($this);

        return \array_filter(
            $data,
            static fn(string $value): bool => isset(static::$propertyCache[static::class][$value]),
            \ARRAY_FILTER_USE_KEY
        );
    }

    public function __clone(): void
    {
        foreach (\get_object_vars($this) as $key => $value) {
            if (\is_object($value) && !$value instanceof \UnitEnum) {
                $this->$key = clone $this->$key;

                continue;
            }

            if (\is_array($value)) {
                $this->$key = ArrayUtil::clone($value);
            }
        }
    }

    private function _loadPropertyCache(): void
    {
        if (!isset(self::$propertyCache[static::class])) {
            self::$propertyCache[static::class] = [];

            foreach (Reflection::getProperties(new \ReflectionClass(static::class)) as $property) {
                self::$propertyCache[static::class][$property->name] = true;
            }
        }
    }
}
