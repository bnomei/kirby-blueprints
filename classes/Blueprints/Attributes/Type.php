<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;
use Bnomei\Blueprints\Schema\FieldTypes;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Type extends GenericAttribute
{
    /**
     * Set the type of the field from the list of official fields
     *
     * @see CustomType if you want to use a custom type like from a plugin
     */
    public function __construct(
        public FieldTypes $type
    ) {
    }
}
