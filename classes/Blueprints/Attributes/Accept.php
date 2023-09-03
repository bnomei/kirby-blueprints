<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Accept extends GenericAttribute
{
    /**
     * If set to all, any type of input is accepted. If set to options only the predefined options are accepted as input.
     */
    public function __construct(
        public string $accept = 'all' // all, options
    ) {
    }
}
