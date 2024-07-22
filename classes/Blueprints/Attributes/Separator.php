<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Separator extends GenericAttribute
{
    /**
     * Custom tags separator, which will be used to store tags in the content file
     */
    public function __construct(
        public string $separator = ','
    ) {}
}
