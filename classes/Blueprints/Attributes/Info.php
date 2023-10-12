<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Info extends GenericAttribute
{
    /**
     * Info text for each item
     */
    public function __construct(
        public string $info
    ) {
    }
}
