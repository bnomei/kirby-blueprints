<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Time extends GenericAttribute
{
    /**
     * Pass true or an array of time field options to show the time selector
     */
    public function __construct(
        public bool $time = false
    ) {
    }
}
