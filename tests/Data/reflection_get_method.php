<?php

declare(strict_types=1);

use Xchert\Util\Test\Dummy\ChildDemoClass;
use Xchert\Util\Test\Dummy\DemoClass;

return (function (): Generator {
    yield from [
        'PublicMethod' => [
            'object' => new DemoClass(),
            'methodName' => 'publicMethod',
            'ignoreStatic' => true,
            'found' => true
        ],
        'ProtectedMethod' => [
            'object' => new DemoClass(),
            'methodName' => 'protectedMethod',
            'ignoreStatic' => true,
            'found' => true
        ],
        'PrivateMethod' => [
            'object' => new DemoClass(),
            'methodName' => 'privateMethod',
            'ignoreStatic' => true,
            'found' => true
        ],
        'IgnoreStatic' => [
            'object' => new DemoClass(),
            'methodName' => 'staticPublicMethod',
            'ignoreStatic' => true,
            'found' => false
        ],
        'DontIgnoreStatic' => [
            'object' => new DemoClass(),
            'methodName' => 'staticPublicMethod',
            'ignoreStatic' => false,
            'found' => true
        ],
        'ParentPublicMethod' => [
            'object' => new ChildDemoClass(),
            'methodName' => 'publicMethod',
            'ignoreStatic' => true,
            'found' => true
        ],
        'ParentProtectedMethod' => [
            'object' => new ChildDemoClass(),
            'methodName' => 'protectedMethod',
            'ignoreStatic' => true,
            'found' => true
        ],
        'ParentPrivateMethod' => [
            'object' => new ChildDemoClass(),
            'methodName' => 'privateMethod',
            'ignoreStatic' => true,
            'found' => true
        ],
        'NonExistingMethod' => [
            'object' => new DemoClass(),
            'methodName' => 'nonExistingMethod',
            'ignoreStatic' => true,
            'found' => false
        ]
    ];
})();