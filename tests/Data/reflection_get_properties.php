<?php

declare(strict_types=1);

use Xchert\Util\Test\Dummy\ChildDemoClass;
use Xchert\Util\Test\Dummy\DemoClass;

return (function (): Generator {
    yield from [
        'AllProperties' => [
            'object' => new DemoClass(),
            'expected' => [
                'publicProperty',
                'protectedProperty',
                'privateProperty',
                'staticPublicProperty',
                'staticProtectedProperty',
            ],
            'ignoreStatic' => false
        ],
        'IgnoreStatic' => [
            'object' => new DemoClass(),
            'expected' => [
                'publicProperty',
                'protectedProperty',
                'privateProperty'
            ],
            'ignoreStatic' => true
        ],
        'IncludeParent' => [
            'object' => new ChildDemoClass(),
            'expected' => [
                'childPublicProperty',
                'childProtectedProperty',
                'childPrivateProperty',
                'staticPublicProperty',
                'staticProtectedProperty',
                'publicProperty',
                'protectedProperty',
                'privateProperty',
            ],
            'ignoreStatic' => false
        ],
        'IncludeParentIgnoreStatic' => [
            'object' => new ChildDemoClass(),
            'expected' => [
                'childPublicProperty',
                'childProtectedProperty',
                'childPrivateProperty',
                'publicProperty',
                'protectedProperty',
                'privateProperty',
            ],
            'ignoreStatic' => true
        ]
    ];
})();