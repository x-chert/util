<?php

declare(strict_types=1);

namespace Xchert\Util;

class Context
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