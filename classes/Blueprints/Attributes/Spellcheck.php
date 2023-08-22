<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Spellcheck
{
    public function __construct(
        public bool $spellcheck
    ) {
    }
}
