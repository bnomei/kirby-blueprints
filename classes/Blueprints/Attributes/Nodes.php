<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Nodes extends GenericAttribute
{
    /**
     * Sets the allowed nodes. Available nodes: paragraph, heading, bulletList, orderedList. Activate/deactivate them all by passing true/false. Default nodes are paragraph, heading, bulletList, orderedList.
     */
    public function __construct(
        public bool|array $nodes = true // ['paragraph', 'heading', 'bulletList', 'orderedList']
    ) {
    }
}
