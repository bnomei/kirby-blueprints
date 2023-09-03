<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class DefaultValue extends GenericAttribute
{
    /**
     * Default value for the field, which will be used when a page/file/user is created
     */
    public function __construct(
        public mixed $default
    ) {
    }
}
