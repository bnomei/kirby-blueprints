<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Allow extends GenericAttribute
{
    /**
     * Set of characters allowed in the slug
     */
    public function __construct(
        public string $allow
    ) {
    }
}
