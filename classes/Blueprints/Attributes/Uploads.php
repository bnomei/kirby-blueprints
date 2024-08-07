<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Uploads extends GenericAttribute
{
    /**
     * Sets the upload options for linked files
     */
    public function __construct(
        public array $uploads = []
    ) {}
}
