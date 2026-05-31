<?php

namespace Xchert\Util\Exception;

class InvalidTypeException extends \Exception
{
    public function __construct(
        private readonly string $expectedType,
        private readonly string $actualType
    ) {
        parent::__construct(\sprintf('Expected type "%s", got "%s"', $this->expectedType, $this->actualType));
    }
}