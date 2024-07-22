<?php

namespace Bnomei\Blueprints;

trait HasStaticMake
{
    /**
     * @param  mixed  ...$args
     */
    public static function make(...$args): self
    {
        return new self(...$args);
    }
}
