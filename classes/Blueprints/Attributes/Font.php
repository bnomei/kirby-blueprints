<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Font extends GenericAttribute
{
    /**
     * Sets the font family (sans or monospace)
     */
    public function __construct(
        public string $font
    ) {
    }
}
