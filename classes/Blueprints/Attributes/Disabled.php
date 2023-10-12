<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Disabled extends GenericAttribute
{
    /**
     * If true, the field is no longer editable and will not be saved
     */
    public function __construct(
        public bool $disabled = false
    ) {
    }
}
