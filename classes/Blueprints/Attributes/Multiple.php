<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Multiple extends GenericAttribute
{
    /**
     * If false, only a single one can be selected
     */
    public function __construct(
        public bool $multiple = false
    ) {
    }
}
