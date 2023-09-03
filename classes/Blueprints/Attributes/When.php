<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class When extends GenericAttribute
{
    /**
     * Conditions when the field will be shown
     */
    public function __construct(
        public mixed $when
    ) {
    }
}
