<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Sortable extends GenericAttribute
{
    /**
     * Toggles drag & drop sorting
     */
    public function __construct(
        public bool $sortable
    ) {}
}
