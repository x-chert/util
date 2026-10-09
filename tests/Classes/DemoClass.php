<?php

namespace Xchert\Util\Test\Classes;

class DemoClass
{
    public static string $staticPublicProperty = 'staticPublic';
    protected static string $staticProtectedProperty = 'staticProtected';
    public string $publicProperty = 'public';
    protected string $protectedProperty = 'protected';
    private string $privateProperty = 'private';

    public function publicMethod(): void {}

    protected function protectedMethod(): void {}

    private function privateMethod(): void {}
}