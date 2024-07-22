<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Converter extends GenericAttribute
{
    /**
     * The field value will be converted with the selected converter before the value gets saved. Available converters: lower, upper, ucfirst, slug
     */
    public function __construct(
        public string $converter
    ) {}
}
