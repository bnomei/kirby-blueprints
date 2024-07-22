<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class After extends GenericAttribute
{
    /**
     * Optional text that will be shown after the input
     *
     * @param  string|array<string,string>  $after
     */
    public function __construct(
        public string|array $after
    ) {}
}
