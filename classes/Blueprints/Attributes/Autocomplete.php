<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Autocomplete extends GenericAttribute
{
    /**
     * Sets the HTML5 autocomplete attribute (tel, url)
     */
    public function __construct(
        public string $autocomplete // tel, url
    ) {
    }
}
