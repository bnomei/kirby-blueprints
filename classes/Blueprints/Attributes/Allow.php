<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
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
