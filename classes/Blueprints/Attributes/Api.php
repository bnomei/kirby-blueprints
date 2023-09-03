<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Api extends GenericAttribute
{
    /**
     * API settings for options requests. This will only take affect when options type is set to api.
     */
    public function __construct(
        public mixed $api
    ) {
    }
}
