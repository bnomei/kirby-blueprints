<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Search extends GenericAttribute
{
    /**
     * Enable/disable the search field in the picker
     */
    public function __construct(
        public bool $search = true
    ) {}
}
