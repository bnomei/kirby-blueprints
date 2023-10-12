<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Autofocus extends GenericAttribute
{
    /**
     * Sets the focus on this field when the form loads. Only the first field with this label gets
     */
    public function __construct(
        public bool $autofocus
    ) {
    }
}
