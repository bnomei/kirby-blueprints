<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class MinRange extends GenericAttribute
{
    /**
     * The lowest allowed number
     */
    public function __construct(
        public float $min
    ) {
    }
}
