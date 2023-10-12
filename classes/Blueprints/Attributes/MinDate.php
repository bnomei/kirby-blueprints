<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MinDate extends GenericAttribute
{
    /**
     * Earliest date, which can be selected/saved (Y-m-d)
     */
    public function __construct(
        public string $min //  (Y-m-d)
    ) {
    }
}
