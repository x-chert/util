<?php

declare(strict_types=1);

return (function (): Generator {
    yield from [
        'Integer' => [
            'value' => 123,
            'expected' => true,
        ],
        'Float' => [
            'value' => 123.456,
            'expected' => true,
        ],
        'String' => [
            'value' => 'string',
            'expected' => true,
        ],
        'Boolean' => [
            'value' => true,
            'expected' => true,
        ],
        'Null' => [
            'value' => null,
            'expected' => true,
        ],
        'EmptyArray' => [
            'value' => [],
            'expected' => true,
        ],
        'NormalizedArray' => [
            'value' => ['foo' => 'bar'],
            'expected' => true,
        ],
        'NonNormalizedArray' => [
            'value' => ['foo' => 'bar', 'baz' => new stdClass()],
            'expected' => false,
        ],
        'Resource' => [
            'value' => fopen('php://memory', 'r'),
            'expected' => false,
        ],
        'Object' => [
            'value' => new stdClass(),
            'expected' => false,
        ]
    ];
})();