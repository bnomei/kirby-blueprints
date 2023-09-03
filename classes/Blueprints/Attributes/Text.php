<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Text extends GenericAttribute
{
    /**
     * Main text for each item
     */
    public function __construct(
        public string $text
    ) {
    }
}
