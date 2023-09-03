<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Inline extends GenericAttribute
{
    /**
     * Enables inline mode, which will not wrap new lines in paragraphs and creates hard breaks instead.
     */
    public function __construct(
        public bool $inline = false
    ) {
    }
}
