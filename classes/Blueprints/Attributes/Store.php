<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Store extends GenericAttribute
{
    /**
     * Whether to store UUID or ID in the content file of the model
     */
    public function __construct(
        public string $store = 'uuid' // uuid, id
    ) {
    }
}
