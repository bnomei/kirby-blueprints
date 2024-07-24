<?php

namespace Bnomei\Blueprints;

trait IsArrayable
{
    public function toArray(): array
    {
        $json_encode = json_encode($this);
        if ($json_encode === false) {
            throw new \Exception('Could not encode to JSON.');
        }

        $data = json_decode($json_encode, true);
        if (! is_array($data)) {
            $data = []; // @codeCoverageIgnore
        }
        ksort($data);

        $data = Blueprint::arraySetKeysFromColumns($data);
        $data = Blueprint::arrayRemoveByValuesRecursive($data, [null, '', []]);

        return $data;
    }
}
