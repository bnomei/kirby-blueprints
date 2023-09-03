<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Pattern extends GenericAttribute
{
    /**
     * A regular expression, which will be used to validate the input
     */
    public function __construct(
        public string $pattern
    ) {
    }
}
