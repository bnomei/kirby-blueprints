<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
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
