<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Layouts extends GenericAttribute
{
    /**
     * @see https://getkirby.com/docs/reference/panel/fields/layout#defining-your-own-layouts
     */
    public function __construct(
        public array $layouts = []
    ) {
    }
}
