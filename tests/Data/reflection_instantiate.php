<?php

declare(strict_types=1);

use Xchert\Util\Test\Dummy\ClassWithOptionalConstructor;
use Xchert\Util\Test\Dummy\ClassWithRequiredConstructor;

return (function (): Generator {
    yield from [
        'OptionalConstructor' => [
            'class' => ClassWithOptionalConstructor::class,
            'expected' => new ClassWithOptionalConstructor(null, 123)
        ],
        'RequiredConstructor' => [
            'class' => ClassWithRequiredConstructor::class,
            'expected' => new ReflectionClass(ClassWithRequiredConstructor::class)->newInstanceWithoutConstructor()
        ],
    ];
})();