<?php

namespace Bnomei\Blueprints;

trait HasStaticMake
{
    /**
     * @param mixed ...$args
     * @return self
     */
    public static function make(...$args): self
    {
        return new self(...$args);
    }
}
