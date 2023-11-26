<?php

namespace Bnomei\Blueprints;

trait HasStaticMake
{
    public static function make(...$args): self
    {
        return new static(...$args);
    }
}
