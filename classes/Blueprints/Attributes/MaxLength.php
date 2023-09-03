<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class MaxLength extends GenericAttribute
{
    /**
     * Maximum number of allowed characters
     */
    public function __construct(
        public int $maxlength
    ) {
    }
}
