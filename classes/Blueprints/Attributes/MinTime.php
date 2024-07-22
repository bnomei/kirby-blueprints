<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MinTime extends GenericAttribute
{
    /**
     * Earliest time, which can be selected/saved (H:i or H:i:s)
     */
    public function __construct(
        public string $min //  (H:i or H:i:s)
    ) {}
}
