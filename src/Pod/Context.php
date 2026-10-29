<?php

declare(strict_types=1);

namespace Xchert\Util\Pod;

class Context extends Pod
{
    public readonly Header $header;

    public function __construct()
    {
        $this->header = new Header();
    }

    public function getHeader(): Header
    {
        return $this->header;
    }
}