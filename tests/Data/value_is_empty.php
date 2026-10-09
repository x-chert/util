<?php

declare(strict_types=1);

return (function (): Generator {
    yield from [
        'Null' => [
            'value' => null,
            'expected' => true,
            'considerWhitespacesAsEmpty' => false,
        ],
        'EmptyString' => [
            'value' => '',
            'expected' => true,
            'considerWhitespacesAsEmpty' => false,
        ],
        'ConsiderWhitespaceString' => [
            'value' => ' ',
            'expected' => true,
            'considerWhitespacesAsEmpty' => true,
        ],
        'NoConsiderWhitespaceString' => [
            'value' => ' ',
            'expected' => false,
            'considerWhitespacesAsEmpty' => false,
        ],
        'EmptyArray' => [
            'value' => [],
            'expected' => true,
            'considerWhitespacesAsEmpty' => false,
        ],
        'NonEmptyArray' => [
            'value' => ['foo'],
            'expected' => false,
            'considerWhitespacesAsEmpty' => false,
        ],
        'ArrayWithNullValue' => [
            'value' => [null],
            'expected' => false,
            'considerWhitespacesAsEmpty' => false,
        ],
        'Zero' => [
            'value' => 0,
            'expected' => false,
            'considerWhitespacesAsEmpty' => false,
        ],
        'ZeroString' => [
            'value' => '0',
            'expected' => false,
            'considerWhitespacesAsEmpty' => false,
        ],
        'Integer' => [
            'value' => 1,
            'expected' => false,
            'considerWhitespacesAsEmpty' => false,
        ],
        'Float' => [
            'value' => 1.0,
            'expected' => false,
            'considerWhitespacesAsEmpty' => false,
        ],
        'True' => [
            'value' => true,
            'expected' => false,
            'considerWhitespacesAsEmpty' => false,
        ],
        'False' => [
            'value' => false,
            'expected' => true,
            'considerWhitespacesAsEmpty' => false,
        ],
    ];
})();