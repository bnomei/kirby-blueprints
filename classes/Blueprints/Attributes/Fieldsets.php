<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Fieldsets extends GenericAttribute
{
    /**
     * @see https://getkirby.com/docs/reference/panel/fields/layout#fieldsets
     */
    public function __construct(
        public array $fieldsets = []
    ) {
    }
}
