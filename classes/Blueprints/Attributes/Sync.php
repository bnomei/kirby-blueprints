<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Sync extends GenericAttribute
{
    /**
     * Name of another field that should be used to automatically update this field's value
     */
    public function __construct(
        public string $sync
    ) {}
}
