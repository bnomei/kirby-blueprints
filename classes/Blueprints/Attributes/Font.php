<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Font extends GenericAttribute
{
    /**
     * Sets the font family (sans or monospace)
     */
    public function __construct(
        public string $font
    ) {}
}
