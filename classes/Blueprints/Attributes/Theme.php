<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Theme extends GenericAttribute
{
    /**
     * Change the design of the info box (info, positive, negative)
     */
    public function __construct(
        public string $theme = 'info'
    ) {}
}
