<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Numbered extends GenericAttribute
{
    /**
     * If false, the prepended number will be hidden
     */
    public function __construct(
        public bool $numbered = false
    ) {
    }
}
