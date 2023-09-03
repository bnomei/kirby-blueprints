<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Width extends GenericAttribute
{
    /**
     * The width of the field in the field grid. Available widths: 1/1, 1/2, 1/3, 1/4, 2/3, 3/4
     */
    public function __construct(
        public float|string $width = '1/1'
    ) {
    }
}
