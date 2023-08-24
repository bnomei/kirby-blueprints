<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class CustomType extends GenericAttribute
{
    public function __construct(
        public string $type // use mixed to allow custom types from plugins
    ) {
    }
}
