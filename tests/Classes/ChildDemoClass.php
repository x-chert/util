<?php

namespace Xchert\Util\Test\Classes;

class ChildDemoClass extends DemoClass
{
    public string $childPublicProperty = 'childPublic';
    protected string $childProtectedProperty = 'childProtected';
    private string $childPrivateProperty = 'childPrivate';

    public function childPublicMetod(): void {}

    protected function childProtectedMethod(): void {}

    private function childPrivateMethod(): void {}
}