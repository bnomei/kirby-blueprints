<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Buttons extends GenericAttribute
{
    /**
     * @param  array<ButtonTypes>  $buttons
     */
    public function __construct(
        public array $buttons
    ) {
    }
}
