<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Spellcheck extends GenericAttribute
{
    public function __construct(
        public bool $spellcheck
    ) {
    }
}
