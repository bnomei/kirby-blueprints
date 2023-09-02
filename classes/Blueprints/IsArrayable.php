<?php

namespace Bnomei\Blueprints;

trait IsArrayable
{
    public function toArray(): array
    {
        $data = json_decode(json_encode($this), true) ?? [];
        ksort($data);

        return $data;
    }
}
