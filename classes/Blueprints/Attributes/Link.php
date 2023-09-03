<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Link extends GenericAttribute
{
    /**
     * Whether each item should be clickable
     */
    public function __construct(
        public bool $link = true
    ) {
    }
}
