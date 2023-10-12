<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MaxRange extends GenericAttribute
{
    /**
     * The maximum value on the slider
     */
    public function __construct(
        public float $max = 100.0
    ) {
    }
}
