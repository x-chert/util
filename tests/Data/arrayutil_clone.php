<?php

declare(strict_types=1);

return (function (): Generator {
    yield from [
        'Scalar' => [
            'value' => [123],
            'expected' => [123]
        ],
        'Nested' => [
            'value' => [[123]],
            'expected' => [[123]]
        ],
        'WithEmptyObject' => [
            'value' => [[new stdClass()]],
            'expected' => [[new stdClass()]]
        ],
        'WithObject' => [
            'value' => (function () {
                $obj = new stdClass();
                $obj->property = 'value';

                return [$obj];
            })(),
            'expected' => (function () {
                $obj = new stdClass();
                $obj->property = 'value';

                return [$obj];
            })()
        ],
    ];
})();