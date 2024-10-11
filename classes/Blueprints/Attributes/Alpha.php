<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Alpha extends GenericAttribute
{
    /**
     * Use the alpha option (default: false) to activate alpha transparency support
     */
    public function __construct(
        public bool $alpha = false
    ) {}
}
