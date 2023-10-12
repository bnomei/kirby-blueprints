<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Layout extends GenericAttribute
{
    /**
     * Changes the layout of the selected entries (list, cards, cardlets)
     */
    public function __construct(
        public string $layout = 'list' // list, cards, cardlets
    ) {
    }
}
