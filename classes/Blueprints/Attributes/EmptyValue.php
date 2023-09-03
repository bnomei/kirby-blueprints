<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class EmptyValue extends GenericAttribute
{
    /**
     * The placeholder text if none have been selected yet
     *
     * @param  string|array<string,string>  $empty
     */
    public function __construct(
        public string|array $empty
    ) {
    }
}
