<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class MaxTime extends GenericAttribute
{
    /**
     * Latest time, which can be selected/saved (H:i or H:i:s)
     */
    public function __construct(
        public string $max //  (H:i or H:i:s)
    ) {
    }
}
