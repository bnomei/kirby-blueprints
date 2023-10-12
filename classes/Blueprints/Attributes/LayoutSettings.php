<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class LayoutSettings extends GenericAttribute
{
    /**
     * @see https://getkirby.com/docs/reference/panel/fields/layout#layout-settings
     */
    public function __construct(
        public array $settings = []
    ) {
    }
}
