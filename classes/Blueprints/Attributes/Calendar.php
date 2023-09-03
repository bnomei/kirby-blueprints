<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Calendar extends GenericAttribute
{
    /**
     * Activate/deactivate the dropdown calendar
     */
    public function __construct(
        public bool $calendar = true
    ) {
    }
}
