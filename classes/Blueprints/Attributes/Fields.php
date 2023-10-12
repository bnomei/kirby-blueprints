<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Fields extends GenericAttribute
{
    /**
     * Fields setup for the object form. Works just like fields in regular forms.
     * --
     * Fields setup for the structure form. Works just like fields in regular forms.
     */
    public function __construct(
        public array $fields = []
    ) {
    }
}
