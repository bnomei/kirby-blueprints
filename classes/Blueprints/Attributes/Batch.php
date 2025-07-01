<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Batch extends GenericAttribute
{
    /**
     * Activates the batch delete option for the section
     */
    public function __construct(
        public bool $batch = false
    ) {}
}
