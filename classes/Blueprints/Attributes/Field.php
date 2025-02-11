<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Field extends GenericAttribute
{
    /**
     * The entries field allows you to create and manage multiple entries for the same field.
     * It offers editors a flexible alternative to the structure field for when they need to
     * handle a list of content that only consists of one field.
     */
    public function __construct(
        public array $field = []
    ) {}
}
