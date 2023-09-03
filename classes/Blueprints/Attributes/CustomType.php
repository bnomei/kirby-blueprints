<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class CustomType extends GenericAttribute
{
    /**
     * Set the type of the field to a custom one like from a plugin
     *
     * @see Type if you want to use one of the official field types
     */
    public function __construct(
        public string $type
    ) {
    }
}
