<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Spellcheck extends GenericAttribute
{
    /**
     * If false, spellcheck will be switched off
     */
    public function __construct(
        public bool $spellcheck = false
    ) {
    }
}
