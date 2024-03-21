<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Blueprint
{
    /**
     * Flag method to be parsed as returning a blueprint definition for the model the method belongs to
     */
    public function __construct(public bool $cacheable = false, public bool $loadPluginsAfter = false)
    {
    }
}
