<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Translate extends GenericAttribute
{
    /**
     * If false, the field will be disabled in non-default languages and cannot be translated. This is only relevant in multi-language setups.
     */
    public function __construct(
        public bool $translate = true
    ) {
    }
}
