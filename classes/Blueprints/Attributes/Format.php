<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Format extends GenericAttribute
{
    /**
     * Defines a custom format that is used when the field is saved
     */
    public function __construct(
        public string $format
    ) {
    }
}
