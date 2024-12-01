<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Mode extends GenericAttribute
{
    /**
     * With the mode option you control which elements of the color field are available. Possible values: picker, input, options.
     */
    public function __construct(
        public string $mode
    ) {}
}
