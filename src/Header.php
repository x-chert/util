<?php

declare(strict_types=1);

namespace Xchert\Util;

use Xchert\Util\Pod\Pod;
use Xchert\Util\Trait\FlagTrait;

class Header extends Pod
{
    use FlagTrait;

    public function __construct(private array $data = [], string ...$flags)
    {
        $this->setFlags(...$flags);
    }

    public function get(string $key, $default = null): mixed
    {
        if (\array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return $default;
    }

    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    public function unset(string $key): void
    {
        unset($this->data[$key]);
    }

    public function has(string $key): bool
    {
        return \array_key_exists($key, $this->data);
    }

    public function toArray(): array
    {
        return $this->data;
    }

}