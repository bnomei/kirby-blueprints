<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Grow extends GenericAttribute
{
    /**
     * Toggles will automatically span the full width of the field. With the grow option, you can disable this behaviour for a more compact layout.
     */
    public function __construct(
        public bool $grow = true
    ) {}
}
