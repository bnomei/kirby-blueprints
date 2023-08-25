<?php

namespace Bnomei\Blueprints;

trait isArrayable
{
    public function toArray(): array
    {
        $data = json_decode(json_encode($this), true) ?? [];
        // empty() would catch 0 and false which is not what we want
        $data = array_filter($data, fn ($value) => $value !== null && $value !== '' && $value !== []);

        ksort($data);

        return $data;
    }
}
