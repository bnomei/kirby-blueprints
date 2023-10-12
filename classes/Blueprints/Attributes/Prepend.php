<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Prepend extends GenericAttribute
{
    /**
     * Toggles adding to the top or bottom of the list
     */
    public function __construct(
        public bool $prepend = false
    ) {
    }
}
