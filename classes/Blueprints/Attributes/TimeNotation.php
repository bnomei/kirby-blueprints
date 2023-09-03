<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class TimeNotation extends GenericAttribute
{
    /**
     * 12 or 24 hour notation. If 12, an AM/PM selector will be shown.
     */
    public function __construct(
        public int $time = 24
    ) {
    }
}
