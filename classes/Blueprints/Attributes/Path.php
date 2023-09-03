<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Path extends GenericAttribute
{
    /**
     * Set prefix for the help text
     */
    public function __construct(
        public string $path
    ) {
    }
}
