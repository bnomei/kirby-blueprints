<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Reset extends GenericAttribute
{
    /**
     * A toggle can be deactivated on click. If reset is false deactivating a toggle is no longer possible.
     */
    public function __construct(
        public bool $reset = true
    ) {
    }
}
