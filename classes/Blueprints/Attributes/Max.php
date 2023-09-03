<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Max extends GenericAttribute
{
    /**
     * The maximum number of allowed selected
     */
    public function __construct(
        public int $max
    ) {
    }
}
