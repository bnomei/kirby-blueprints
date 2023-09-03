<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Subpages extends GenericAttribute
{
    /**
     * Optionally include subpages of pages
     */
    public function __construct(
        public bool $subpages = true
    ) {
    }
}
