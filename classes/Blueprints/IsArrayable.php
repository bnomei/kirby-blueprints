<?php

namespace Bnomei\Blueprints;

trait IsArrayable
{
    public function toArray(): array
    {
        $data = json_decode(json_encode($this), true) ?? [];
        ksort($data);

        $data = Blueprint::arraySetKeysFromColumns($data);
        $data = Blueprint::arrayRemoveByValuesRecursive($data, [null, '', []]);

        return $data;
    }
}
