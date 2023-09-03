<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class SortBy extends GenericAttribute
{
    /**
     * Sorts the entries by the given field and order (i.e. title desc) Drag & drop is disabled in this case
     */
    public function __construct(
        public string $sortby
    ) {
    }
}
