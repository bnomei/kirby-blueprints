<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Tooltip extends GenericAttribute
{
    /**
     * Enables/disables the tooltip and set the before and after values
     */
    public function __construct(
        public bool $tooltip
    ) {
    }
}
