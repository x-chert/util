<?php

declare(strict_types=1);

namespace Xchert\Util\Test\Dummy;

class ClassWithOptionalConstructor
{
    public function __construct(
        public ?string $string,
        public int $int = 123,
    ) {}
}