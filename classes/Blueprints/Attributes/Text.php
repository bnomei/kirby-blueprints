<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Text extends GenericAttribute
{
    /**
     * Main text for each item
     */
    public function __construct(
        public string $text
    ) {}
}
