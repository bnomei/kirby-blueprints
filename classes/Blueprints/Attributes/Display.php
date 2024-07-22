<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Display extends GenericAttribute
{
    /**
     * Custom format (dayjs tokens: DD, MM, YYYY) that is used to display the field in the Panel
     */
    public function __construct(
        public string $display = 'YYYY-MM-DD'
    ) {}
}
