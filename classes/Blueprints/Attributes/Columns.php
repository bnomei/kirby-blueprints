<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Columns extends GenericAttribute
{
    /**
     * @see https://getkirby.com/docs/reference/panel/fields/layout#layout-settings
     */
    public function __construct(
        public array $columns = []
    ) {
    }
}
