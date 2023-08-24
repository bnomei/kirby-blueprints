<?php

namespace Bnomei\Blueprints\Attributes;

class GenericAttribute
{
    public function toArray(): array
    {
        return json_decode(json_encode($this), true);
    }
}
