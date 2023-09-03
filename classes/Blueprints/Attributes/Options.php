<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Options extends GenericAttribute
{
    /**
     * An array with options
     */
    public function __construct(
        public array $options
    ) {
    }
}
