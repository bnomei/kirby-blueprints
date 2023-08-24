<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Label extends GenericAttribute
{
    /**
     * @param  string|array<string,string>  $label
     */
    public function __construct(
        public string|array $label
    ) {
    }
}
