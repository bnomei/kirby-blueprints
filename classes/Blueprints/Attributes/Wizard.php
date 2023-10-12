<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Wizard extends GenericAttribute
{
    /**
     * Set to object with keys field and text to add button to generate from another field
     */
    public function __construct(
        public bool $wizard = false
    ) {
    }
}
