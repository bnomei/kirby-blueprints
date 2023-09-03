<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Before extends GenericAttribute
{
    /**
     * Optional text that will be shown before the input
     *
     * @param  string|array<string,string>  $before
     */
    public function __construct(
        public string|array $before
    ) {
    }
}
