<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Max extends GenericAttribute
{
    /**
     * The maximum number of allowed selected
     */
    public function __construct(
        public int $max
    ) {}
}
