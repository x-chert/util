<?php

declare(strict_types=1);

use Xchert\Util\Type;

return (function (): Generator {
    yield from [
        'Integer' => [
            'value' => 123,
            'compareType' => Type::INT,
            'expected' => true
        ],
        'Boolean' => [
            'value' => true,
            'compareType' => Type::BOOL,
            'expected' => true
        ],
        'String' => [
            'value' => 'test',
            'compareType' => Type::STRING,
            'expected' => true
        ],
        'Float' => [
            'value' => 123.45,
            'compareType' => Type::FLOAT,
            'expected' => true
        ],
        'NumericFloat' => [
            'value' => 123.45,
            'compareType' => Type::NUMERIC,
            'expected' => true
        ],
        'NumericInteger' => [
            'value' => 123,
            'compareType' => Type::NUMERIC,
            'expected' => true
        ],
        'NumericString' => [
            'value' => '123',
            'compareType' => Type::NUMERIC,
            'expected' => false
        ],
        'Object' => [
            'value' => new stdClass(),
            'compareType' => Type::OBJECT,
            'expected' => true
        ],
        'Class' => [
            'value' => new stdClass(),
            'compareType' => stdClass::class,
            'expected' => true
        ],
        'NonExistingClass' => [
            'value' => new stdClass(),
            'compareType' => 'nonExistingClass',
            'expected' => false
        ],
        'Array' => [
            'value' => [],
            'compareType' => Type::ARRAY,
            'expected' => true
        ]
    ];
})();