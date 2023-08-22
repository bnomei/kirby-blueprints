<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class MaxLength
{
    public function __construct(
        public int $maxlength
    ) {
    }
}
