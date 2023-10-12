<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Image extends GenericAttribute
{
    /**
     * Image settings for each item
     */
    public function __construct(
        public string|array $image
    ) {
    }
}
