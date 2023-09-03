<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class MaxDate extends GenericAttribute
{
    /**
     * Latest date, which can be selected/saved (Y-m-d)
     */
    public function __construct(
        public string $max //  (Y-m-d)
    ) {
    }
}
