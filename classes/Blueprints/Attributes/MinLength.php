<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class MinLength extends GenericAttribute
{
    /**
     * Minimum number of required characters
     */
    public function __construct(
        public int $minlength
    ) {
    }
}
