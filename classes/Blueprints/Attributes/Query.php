<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Query extends GenericAttribute
{
    /**
     * Query for the items to be included in the picker.
     * --
     * Query settings for options queries. This will only take affect when options is set to query.
     */
    public function __construct(
        public string $query
    ) {
    }
}
