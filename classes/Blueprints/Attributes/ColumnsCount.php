<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ColumnsCount extends GenericAttribute
{
    /**
     * Arranges the radio buttons in the given number of columns
     */
    public function __construct(
        public int $columns = 1
    ) {}
}
