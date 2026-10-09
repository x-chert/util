<?php

declare(strict_types=1);

return (function (): Generator {
    yield from [
        'Array' => [
            'iterator' => [123],
            'expected' => [123]
        ],
        'AssociativeArray' => [
            'iterator' => ['key' => 'value'],
            'expected' => ['key' => 'value']
        ],
        'FlatGenerator' => [
            'iterator' => (function () {
                yield 123;
                yield 456;
            })(),
            'expected' => [123, 456]
        ],
        'AssociativeFlatGenerator' => [
            'iterator' => (function () {
                yield 'key1' => 'value1';
                yield 'key2' => 'value2';
            })(),
            'expected' => [
                'key1' => 'value1',
                'key2' => 'value2'
            ]
        ],
        'NestedGenerator' => [
            'iterator' => (function () {
                $data = [
                    [1, 2, 3],
                    [4, 5, 6]
                ];

                foreach ($data as $item) {
                    yield from $item;
                }
            })(),
            'expected' => [1, 2, 3, 4, 5, 6]
        ],
        'NestedAssociativeGenerator' => [
            'iterator' => (function () {
                $data = [
                    ['foo1' => 'bar1', 'foo2' => 'bar2'],
                    ['foo1' => 'bar1', 'foo3' => 'bar3']
                ];

                foreach ($data as $item) {
                    yield from $item;
                }
            })(),
            'expected' => [
                'foo1' => 'bar1',
                'foo2' => 'bar2',
                'foo3' => 'bar3'
            ]
        ]
    ];
})();