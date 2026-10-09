<?php

declare(strict_types=1);

return (function (): Generator {
    yield from [
        'Integer' => [
            'value' => 123,
            'expected' => 123,
            'expectedException' => null,
        ],
        'String' => [
            'value' => '123',
            'expected' => '123',
            'expectedException' => null,
        ],
        'Float' => [
            'value' => 123.456,
            'expected' => 123.456,
            'expectedException' => null,
        ],
        'Boolean' => [
            'value' => true,
            'expected' => true,
            'expectedException' => null,
        ],
        'Null' => [
            'value' => null,
            'expected' => null,
            'expectedException' => null,
        ],
        'Array' => [
            'value' => [1, 2, 3],
            'expected' => [1, 2, 3],
            'expectedException' => null,
        ],
        'AssociativeArray' => [
            'value' => ['a' => 1, 'b' => 2, 'c' => 3],
            'expected' => ['a' => 1, 'b' => 2, 'c' => 3],
            'expectedException' => null,
        ],
        'EmptyObject' => [
            'value' => new stdClass(),
            'expected' => [],
            'expectedException' => null,
        ],
        'Object' => [
            'value' => (function () {
                $obj = new stdClass();
                $obj->prop = 'value';

                return $obj;
            })(),
            'expected' => ['prop' => 'value'],
            'expectedException' => null,
        ],
        'Resource' => [
            'value' => fopen('php://memory', 'r'),
            'expected' => null,
            'expectedException' => RuntimeException::class,
        ]
    ];
})();