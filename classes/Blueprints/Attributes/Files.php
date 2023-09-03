<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Files extends GenericAttribute
{
    /**
     * Sets the options for the files picker
     */
    public function __construct(
        public array $files = []
    ) {
    }
}
