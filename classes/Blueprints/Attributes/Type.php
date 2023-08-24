<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Type extends GenericAttribute
{
    public function __construct(
        public FieldTypes $type // use mixed to allow custom types from plugins
    ) {
    }
}
