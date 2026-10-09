<?php

declare(strict_types=1);

return (function (): Generator {
    yield from [
        'Scalar' => [
            'value' => 123,
            'expected' => [123]
        ],
        'Array' => [
            'value' => [123],
            'expected' => [123]
        ],
        'Object' => [
            'value' => new stdClass(),
            'expected' => [new stdClass()]
        ],
        'Null' => [
            'value' => null,
            'expected' => []
        ],
    ];
})();