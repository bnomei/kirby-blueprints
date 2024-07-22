<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Step extends GenericAttribute
{
    /**
     * Round to the nearest: sub-options for unit (day) and size (1)
     */
    public function __construct(
        public array $step = [] // ['unit' => 'd', 'size' => 1]
    ) {}
}
