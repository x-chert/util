<?php

declare(strict_types=1);

namespace Xchert\Util\Pod;

class Collection extends Pod implements \IteratorAggregate, \Countable
{
    protected array $items = [];

    public function __construct(array $items = [])
    {
        foreach ($items as $key => $item) {
            if (!\is_string($key)) {
                $key = null;
            }

            $this->add($item, $key);
        }
    }

    public function add(mixed $item, ?string $key = null): void
    {
        $this->validateType($item);

        if ($key === null) {
            $key = $this->createKey($item);

            if ($key === null) {
                $this->items[] = $item;

                return;
            }
        }

        $this->items[$key] = $item;
    }

    public function remove(string $key): void
    {
        unset($this->items[$key]);
    }

    public function get(string|int $key): mixed
    {
        if (\is_int($key)) {
            return \array_values($this->items)[$key] ?? null;
        }

        return $this->items[$key] ?? null;
    }

    public function clear(): void
    {
        $this->items = [];
    }

    public function keys(): array
    {
        return \array_keys($this->items);
    }

    public function has(string $key): bool
    {
        return \array_key_exists($key, $this->items);
    }

    public function map(callable $callable): array
    {
        return \array_map($callable, $this->items);
    }

    public function sort(callable $callable): void
    {
        \uasort($this->items, $callable);
    }

    public function filter(?callable $callable = null): static
    {
        try {
            $new = (new \ReflectionClass(static::class))->newInstanceWithoutConstructor();
        } catch (\ReflectionException $e) {
            throw new \RuntimeException($e->getMessage());
        }

        $new->items = \array_filter($this->items, $callable);

        return $new;
    }

    public function firstItem(): mixed
    {
        return $this->items[\array_key_first($this->items)] ?? null;
    }

    public function lastItem(): mixed
    {
        return $this->items[\array_key_last($this->items)] ?? null;
    }

    public function getIterator(): \Traversable
    {
        yield from $this->items;
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function jsonSerialize(): array
    {
        return \array_values($this->items);
    }

    protected function validateType(mixed $item): void
    {
        if (!$this->supports($item)) {
            throw new \InvalidArgumentException(\sprintf('Item of type %s is not supported.', \get_debug_type($item)));
        }
    }

    protected function supports(mixed $value): bool
    {
        return \is_object($value) || \is_array($value) || \is_scalar($value);
    }

    protected function createKey(mixed $value): ?string
    {
        return null;
    }
}