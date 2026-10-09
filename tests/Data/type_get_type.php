<?php

declare(strict_types=1);

use Xchert\Util\Type;

return (function (): Generator {
    yield from [
        'Integer' => [
            'value' => 123,
            'expected' => Type::INT
        ],
        'Boolean' => [
            'value' => true,
            'expected' => Type::BOOL
        ],
        'Float' => [
            'value' => 123.456,
            'expected' => Type::FLOAT
        ],
        'String' => [
            'value' => 'Hello',
            'expected' => Type::STRING
        ],
        'Array' => [
            'value' => [],
            'expected' => Type::ARRAY
        ],
        'Object' => [
            'value' => new stdClass(),
            'expected' => Type::OBJECT
        ],
        'Null' => [
            'value' => null,
            'expected' => Type::NULL
        ],
        'Unknown' => [
            'value' => fopen('php://memory', 'r'),
            'expected' => Type::UNKNOWN
        ]
    ];
})();