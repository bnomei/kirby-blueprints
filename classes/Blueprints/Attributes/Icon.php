<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Icon extends GenericAttribute
{
    /**
     * Optional icon that will be shown at the end of the field
     *
     * @param  string|Icon  $icon
     */
    public function __construct(
        public mixed $icon
    ) {
    }
}
