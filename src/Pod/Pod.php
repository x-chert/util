<?php

namespace Xchert\Util\Pod;

use Xchert\Util\ArrayUtil;

class Pod implements \JsonSerializable
{
    public static function from(Pod $pod): static
    {
        try {
            $self = (new \ReflectionClass(static::class))
                ->newInstanceWithoutConstructor();
        } catch(\ReflectionException $e) {
            throw new \RuntimeException($e->getMessage());
        }

        $self->allocate($pod->toArray());

        return $self;
    }

    public function allocate(array $data): void
    {
        foreach($data as $key => $value) {
            try {
                $this->$key = $value;
            } catch(\Throwable $error) {
                // do nothing
            }
        }
    }

    public function jsonSerialize(): array
    {
        $data = \get_object_vars($this);

        foreach($data as &$value) {
            if($value instanceof \DateTimeInterface) {
                $value = $value->format(\DateTimeInterface::RFC3339_EXTENDED);
            }
        }

        return $data;
    }

    public function toArray(): array
    {
        return \get_object_vars($this);
    }

    public function __clone(): void
    {
        foreach(\get_object_vars($this) as $key => $value) {
            if(\is_object($value) && !$value instanceof \UnitEnum) {
                $this->$key = clone $this->$key;

                continue;
            }

            if(\is_array($value)) {
                $this->$key = ArrayUtil::clone($value);
            }
        }
    }
}
