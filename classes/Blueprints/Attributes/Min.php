<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Min extends GenericAttribute
{
    /**
     * The minimum number of required selected
     */
    public function __construct(
        public int $min
    ) {
    }
}
