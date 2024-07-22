<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MinRange extends GenericAttribute
{
    /**
     * The lowest allowed number
     */
    public function __construct(
        public float $min
    ) {}
}
