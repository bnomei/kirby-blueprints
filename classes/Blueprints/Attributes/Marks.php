<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Marks extends GenericAttribute
{
    /**
     * Sets the allowed HTML formats. Available formats: bold, italic, underline, strike, code, link, email. Activate them all by passing true. Deactivate them all by passing false
     */
    public function __construct(
        public bool|array $marks = true // ['bold', 'italic', 'underline', 'strike', 'code', 'link', 'email']
    ) {}
}
