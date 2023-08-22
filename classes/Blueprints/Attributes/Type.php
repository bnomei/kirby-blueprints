<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
final class Type
{
    /**
     * @param  FieldTypes|string  $type
     */
    public function __construct(
        public mixed $type // use mixed to allow custom types from plugins
    ) {
    }
}
