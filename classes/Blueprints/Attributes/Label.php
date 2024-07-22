<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Label extends GenericAttribute
{
    /**
     * The field label can be set as string or associative array with translations
     *
     * @param  string|array<string,string>  $label
     */
    public function __construct(
        public string|array $label
    ) {}
}
