<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Counter extends GenericAttribute
{
    /**
     * Shows or hides the character counter in the top right corner
     */
    public function __construct(
        public bool $counter = true
    ) {
    }
}
