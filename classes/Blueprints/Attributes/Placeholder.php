<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Placeholder extends GenericAttribute
{
    /**
     * Optional placeholder value that will be shown when the field is empty
     */
    public function __construct(
        public string $placeholder
    ) {
    }
}
