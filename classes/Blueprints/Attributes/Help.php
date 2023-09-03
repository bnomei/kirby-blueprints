<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Help extends GenericAttribute
{
    /**
     * Optional help text below the field
     */
    public function __construct(
        public string $help
    ) {
    }
}
