<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;
use Bnomei\Blueprints\Schema\Button;

#[Attribute(Attribute::TARGET_METHOD)]
class Buttons extends GenericAttribute
{
    /**
     * @param  array<Button>  $buttons
     */
    public function __construct(
        public array $buttons
    ) {
    }
}
