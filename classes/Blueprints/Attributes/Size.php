<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Size extends GenericAttribute
{
    /**
     * Changes the size of the textarea. Available sizes: small, medium, large, huge
     */
    public function __construct(
        public string $size // small, medium, large, huge
    ) {
    }
}
