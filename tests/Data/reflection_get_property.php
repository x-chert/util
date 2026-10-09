<?php

declare(strict_types=1);

use Xchert\Util\Test\Dummy\ChildDemoClass;
use Xchert\Util\Test\Dummy\DemoClass;

return (function (): Generator {
    yield from [
        'PublicProperty' => [
            'object' => new DemoClass(),
            'propertyName' => 'publicProperty',
            'ignoreStatic' => true,
            'found' => true,
        ],
        'IgnoreStatic' => [
            'object' => new DemoClass(),
            'propertyName' => 'staticPublicProperty',
            'ignoreStatic' => true,
            'found' => false,
        ],
        'DontIgnoreStatic' => [
            'object' => new DemoClass(),
            'propertyName' => 'staticPublicProperty',
            'ignoreStatic' => false,
            'found' => true,
        ],
        'ProtectedProperty' => [
            'object' => new DemoClass(),
            'propertyName' => 'protectedProperty',
            'ignoreStatic' => true,
            'found' => true,
        ],
        'PublicParentProperty' => [
            'object' => new ChildDemoClass(),
            'propertyName' => 'publicProperty',
            'ignoreStatic' => true,
            'found' => true,
        ],
        'ProtectedParentProperty' => [
            'object' => new ChildDemoClass(),
            'propertyName' => 'protectedProperty',
            'ignoreStatic' => true,
            'found' => true,
        ],
        'PrivateParentProperty' => [
            'object' => new ChildDemoClass(),
            'propertyName' => 'privateProperty',
            'ignoreStatic' => true,
            'found' => true,
        ],
        'NonExistingProperty' => [
            'object' => new DemoClass(),
            'propertyName' => 'nonExistingProperty',
            'ignoreStatic' => true,
            'found' => false,
        ],
    ];
})();