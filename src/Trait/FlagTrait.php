<?php

namespace Xchert\Util\Trait;

trait FlagTrait
{
    private array $flags = [];

    public function hasFlags(string ...$flags): bool
    {
        if (empty($flags)) {
            return !empty($this->flags);
        }

        foreach ($flags as $flag) {
            if (!isset($this->flags[$flag])) {
                return false;
            }
        }

        return true;
    }

    public function hasAtLeastOneFlag(string ...$flags): bool
    {
        if (empty($flags)) {
            return !empty($this->flags);
        }

        foreach ($flags as $flag) {
            if (isset($this->flags[$flag])) {
                return true;
            }
        }

        return false;
    }

    public function getFlags(): array
    {
        return $this->flags;
    }

    public function setFlags(string ...$flags): void
    {
        $this->flags = [];

        foreach ($flags as $flag) {
            $this->flags[$flag] = $flag;
        }
    }

    public function addFlag(string $flag): void
    {
        $this->flags[$flag] = $flag;
    }

    public function removeFlag(string $flag): void
    {
        unset($this->flags[$flag]);
    }

}
