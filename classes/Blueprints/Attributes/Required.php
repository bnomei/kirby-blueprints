<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Required extends GenericAttribute
{
    /**
     * If true, the field has to be filled in correctly to be saved
     */
    public function __construct(
        public bool $required
    ) {
    }
}
