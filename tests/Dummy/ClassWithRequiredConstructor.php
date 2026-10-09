<?php

declare(strict_types=1);

namespace Xchert\Util\Test\Dummy;

class ClassWithRequiredConstructor
{
    public function __construct(public int $int, public ?string $string = null) {}
}