<?php

namespace Xchert\Util\Test\Dummy;

class DemoClass
{
    public static string $staticPublicProperty = 'staticPublic';
    protected static string $staticProtectedProperty = 'staticProtected';
    public string $publicProperty = 'public';
    protected string $protectedProperty = 'protected';
    private string $privateProperty = 'private';

    public static function staticPublicMethod(): void {}

    protected static function staticProtectedMethod(): void {}

    private static function staticPrivateMethod(): void {}

    public function publicMethod(): void {}

    protected function protectedMethod(): void {}

    private function privateMethod(): void {}
}